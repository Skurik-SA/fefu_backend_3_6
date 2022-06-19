<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Exception;

/**
 * App\Models\ProductCategory
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $slug
 * @property int|null $parent_id
 * @property-read Collection|ProductCategory[] $children
 * @property-read int|null $children_count
 * @property-read Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\ProductCategoryFactory factory(...$parameters)
 * @method static Builder|ProductCategory findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static Builder|ProductCategory newModelQuery()
 * @method static Builder|ProductCategory newQuery()
 * @method static Builder|ProductCategory query()
 * @method static Builder|ProductCategory whereCreatedAt($value)
 * @method static Builder|ProductCategory whereId($value)
 * @method static Builder|ProductCategory whereName($value)
 * @method static Builder|ProductCategory whereParentId($value)
 * @method static Builder|ProductCategory whereSlug($value)
 * @method static Builder|ProductCategory whereUpdatedAt($value)
 * @method static Builder|ProductCategory withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @mixin \Eloquent
 */
class ProductCategory extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name', 'slug', 'parent_id'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public static function getTreeProductsBuilder(Collection $categories): Builder
    {
        $categoryIds = [];

        if ($categories->isEmpty()){
            throw new Exception('no categories');
        }

        $collectCategoryIds = function (ProductCategory $category) use (&$categoryIds, &$collectCategoryIds) {
            $categoryIds[] = $category->id;
            foreach ($category->children as $childCategory) {
                $collectCategoryIds($childCategory);
            }
        };

        foreach ($categories as $category){
            $collectCategoryIds($category);
        }

        return Product::query()->whereIn('product_category_id', $categoryIds);
    }
}
