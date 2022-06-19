<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Appeal
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 * @property string $message
 * @property int|null $user_id
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Appeal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Appeal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Appeal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Appeal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appeal whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appeal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appeal whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appeal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appeal wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appeal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Appeal whereUserId($value)
 */
	class Appeal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\News
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property string $title
 * @property string $slug
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\NewsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|News findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News published()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 */
	class News extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Page
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PageFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Page findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 */
	class Page extends \Eloquent {}
}

namespace App\Models{
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
 * @method static \Illuminate\Database\Eloquent\Builder|Product findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product search(string $searchQuery)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProductCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductAttribute
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $type
 * @property int $sort_order
 * @method static \Database\Factories\ProductAttributeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttribute whereUpdatedAt($value)
 */
	class ProductAttribute extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductAttributeValue
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $value
 * @property int $product_id
 * @property int $product_attribute_id
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\ProductAttribute $productAttribute
 * @method static \Database\Factories\ProductAttributeValueFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereProductAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductAttributeValue whereValue($value)
 */
	class ProductAttributeValue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductCategory
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $slug
 * @property int|null $parent_id
 * @property-read \Illuminate\Database\Eloquent\Collection|ProductCategory[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\ProductCategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 */
	class ProductCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $github_id
 * @property \Illuminate\Support\Carbon|null $github_logged_in_at
 * @property \Illuminate\Support\Carbon|null $github_registered_at
 * @property \Illuminate\Support\Carbon|null $app_logged_in_at
 * @property \Illuminate\Support\Carbon|null $app_registered_at
 * @property string|null $vkontakte_id
 * @property \Illuminate\Support\Carbon|null $vkontakte_logged_in_at
 * @property \Illuminate\Support\Carbon|null $vkontakte_registered_at
 * @property string|null $google_id
 * @property \Illuminate\Support\Carbon|null $google_logged_in_at
 * @property \Illuminate\Support\Carbon|null $google_registered_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAppLoggedInAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAppRegisteredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGithubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGithubLoggedInAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGithubRegisteredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGoogleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGoogleLoggedInAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGoogleRegisteredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVkontakteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVkontakteLoggedInAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVkontakteRegisteredAt($value)
 */
	class User extends \Eloquent {}
}

