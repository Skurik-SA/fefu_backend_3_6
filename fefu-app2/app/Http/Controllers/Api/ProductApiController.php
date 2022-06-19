<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\CatalogApiRequest;
use App\Http\Resources\ListProductResource;
use App\Http\Resources\DetailedProductResource;
use Illuminate\Http\Response;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\OpenApi\Parameters\ProductsListParameters;
use App\OpenApi\Parameters\ProductDetailsParameters;
use App\OpenApi\Responses\ProductsListResponse;
use App\OpenApi\Responses\ErrorValidationResponse;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Exception;
use App\Models\Product;
use App\OpenApi\Responses\ErrorCatalogResponse;
use App\OpenApi\Responses\ProductResponse;
use App\OpenApi\Responses\NotFoundResponse;
use App\Http\Requests\CatalogApiRequest;
use App\Http\Filters\ProductFilter;

#[OpenApi\PathItem]
class ProductApiController extends Controller
{
    /**
     * Returning a list of products by slug.
     *
     * @param CatalogApiRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\Responseble
     */
    #[OpenApi\Operation(tags: ["product"])]
    #[OpenApi\Response(factory: ProductsListResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: ErrorCatalogResponse::class, statusCode: 422)]
    #[OpenApi\Parameters(factory: ProductsListParameters::class)]
    public function index(CatalogApiRequest $request) {
        $requestData = $request->validated();;
        $slug = $requestData['category_slug'];

        $query = ProductCategory::query()->with('children', 'products');

        if ($slug === null) {
            $query->where('parent_id');
        } else {
            $query->where('slug', $slug);
        }

        $categories = $query->get();

        try{
            $products = ProductCategory::getTreeProductsBuilder($categories);
        }catch(Exception $exception) {
            return response()->json([
                'message' => 'Error',
                'errors' => [$exception->getMessage()],
            ], 422);
        }

        $appliedFilters = $requestData['filters'] ?? [];
        ProductFilter::apply($products, $appliedFilters);

        if (isset($requestData['search_query'])) {
            $products->search($requestData['search_query']);
        }

        $sortMode = $requestData['sort_mode'] ?? null;
        if ($sortMode === 'price_asc') {
            $products->orderBy('price');
        } else if ($sortMode === 'price_desc') {
            $products->orderBy('price', 'desc');
        }

        return ListProductResource::collection(
            $products->orderBy('products.id')->paginate()
        );
    }
    /**
     * Returning a product resource by the requested slug
     *
     * @return DetailedProductResource|Response
     */
    #[OpenApi\Operation(tags: ["product"])]
    #[OpenApi\Response(factory: ProductResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: NotFoundResponse::class, statusCode: 404)]
    #[OpenApi\Parameters(factory: ProductDetailsParameters::class)]
    public function show(Request $request) {
        $slug = $request->query('product_slug');
        return new DetailedProductResource(
            Product::query()
                ->with('productCategory', 'sortedAttributeValues.productAttribute')
                ->where('slug', $slug)
                ->firstOrFail()
        );
    }
}
