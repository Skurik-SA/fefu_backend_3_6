<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListProductResource;
use App\Http\Resources\DetailedProductResource;
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

#[OpenApi\PathItem]
class ProductApiController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    #[OpenApi\Operation(tags: ["catalog"])]
    #[OpenApi\Response(factory: ProductsListResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: ErrorCatalogResponse::class, statusCode: 422)]
    #[OpenApi\Parameters(factory: ProductsListParameters::class)]
    public function index(Request $request) {
        $slug = $request->query('category_slug');
        $query = ProductCategory::query()->with('children', 'products');

        if ($slug === null) {
            $query->where('parent_id');
        } else {
            $query->where('slug', $slug);
        }

        $categories = $query->get();

        try{
            $products = ProductCategory::getTreeProductsBuilder($categories)
                ->orderBy('id')
                ->paginate();
        }catch(Exception $exception) {
            return response()->json([
                'message' => 'Error',
                'errors' => [$exception->getMessage()],
            ], 422);
        }

        return ListProductResource::collection($products);
    }

    /**
     * @param Request $request
     * @return DetailedProductResource
     */
    #[OpenApi\Operation(tags: ["catalog"])]
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
