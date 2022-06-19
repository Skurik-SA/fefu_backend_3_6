<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property float $price
 * @property int $product_category_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductAttributeValue[] $attributeValues
 * @property-read int|null $attribute_values_count
 * @property-read \App\Models\ProductCategory $productCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductAttributeValue[] $sortedAttributeValues
 * @property-read int|null $sorted_attribute_values_count
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static Builder|Product findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product search(string $searchQuery)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product wherePrice($value)
 * @method static Builder|Product whereProductCategoryId($value)
 * @method static Builder|Product whereSlug($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @method static Builder|Product withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name', 'slug', 'price', 'description', 'product_category_id'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function attributeValues(): HasMany
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

    public function sortedAttributeValues(): HasMany
    {
        return $this
            ->attributeValues()
            ->join('product_attributes', 'product_attributes.id', '=', 'product_attribute_values.product_attribute_id')
            ->orderBy('product_attributes.sort_order')
            ->orderBy('product_attributes.id');
    }

    public function scopeSearch(Builder $builder, string $searchQuery) : Builder{
        return $builder->where('products.name', 'ilike', "%$searchQuery%");
    }
}
