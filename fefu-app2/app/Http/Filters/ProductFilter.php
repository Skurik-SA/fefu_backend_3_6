<?php

namespace App\Http\Filters;

use App\Models\ProductAttribute;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ProductAttributeValue;
use Illuminate\Database\Query\JoinClause;
use SebastianBergmann\CodeCoverage\Driver\Selector;

class ProductFilter
{
    private const KEY_PREFIX = 'top';
    public string $key;
    public string $name;
    public int $type;
    public array $options;

    public function __construct($key, $name, $type, $options)
    {
        $this->key = $key;
        $this->name = $name;
        $this->type = $type;
        $this->options = $options;
    }

    private static function makeKey(ProductAttribute $attribute): string{
        return self::KEY_PREFIX . $attribute->id;
    }

    public static function build(Builder $productQuery, array $appliedFilters): array{
        $attributes = ProductAttribute::get();

        $productIdsQuery = (clone $productQuery)->select('products.id');

        $attributeValues = ProductAttributeValue::query()
            ->select('product_attribute_id', 'value')
            ->selectRaw('count(distinct products.id) as product_count')
            ->whereIn('product_id', $productIdsQuery)
            ->groupBy('product_attribute_id', 'value')
            ->join('products', 'products.id', '=', 'product_attribute_values.product_id')
            ->get();

        $attributeValuesByAttrId = [];
        foreach ($attributeValues as $attributeValue){
            $attributeValuesByAttrId[$attributeValue->product_attribute_id][] = $attributeValue;
        }

        $filters = [];
        foreach ($attributes as $attribute){
            if (isset($attributeValuesByAttrId[$attribute->id])) {
                $key = self::makeKey($attribute);

                $options = [];
                foreach ($attributeValuesByAttrId[$attribute->id] as $item){
                    $isSelected = false;
                    if (isset($appliedFilters[$key]) && in_array($item->value, $appliedFilters[$key])){
                        $isSelected = true;
                    }
                    $options[] = new ProductFilterOption($item->value, $isSelected, $item->product_count);
                }

                $filters[] = new ProductFilter(
                    self::makeKey($attribute),
                    $attribute->name,
                    (int)$attribute->type,
                    $options,
                );
            }
        }

        return $filters;
    }

    public static function apply(Builder $productQuery, array $appliedFilters): void{
        $attributeByKey = [];
        foreach (ProductAttribute::get() as $item){
            $attributeByKey[self::makeKey($item)] = $item;
        }

        foreach ($appliedFilters as $key => $values) {
            $attribute = $attributeByKey[$key] ?? null;
            if ($attribute === null){
                continue;
            }

            if (count($values) > 0){
                $productQuery
                    ->join(
                        "product_attribute_values",
                        function(JoinClause $clause) use ($attribute, $values): void {
                            $clause->on("product_id", '=', 'products.id')
                                ->where("product_attribute_id", $attribute->id)
                                ->whereIn("value", $values);
                        });
            }
        }
    }
}
