<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\CatalogFormRequest;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    const PER_PAGE = 10;

    /**
     * Display a listing of the resource.
     *
     * @param CatalogFormRequest $request
     * @param string|null $slug
     * @return Application|Factory|View
     */
    public function index(CatalogFormRequest $request, string $slug = null)
    {
        $requestData = $request->validated();
        $query = ProductCategory::query()->with('children', 'products');
//        $query = ProductCategory::query()->with('children');

        if ($slug === null) {
            $query->where('parent_id');
        } else {
            $query->where('slug', $slug);
        }

        $categories = $query->get();

        try{
            $products = ProductCategory::getTreeProductsBuilder($categories);
        }catch(Exception $exception) {
            abort(422, $exception->getMessage());
        }

        $filters = ProductFilter::build($products, $requestData['filters'] ?? []);
        ProductFilter::apply($products, $requestData['filters'] ?? []);

        if (isset($requestData['search_query'])) {
            $products->search($requestData['search_query']);
        }

        $sortMode = $requestData['sort_mode'] ?? null;
        if ($sortMode === 'price_asc') {
            $products->orderBy('price');
        } else if ($sortMode === 'price_desc') {
            $products->orderBy('price', 'desc');
        }

        return view('catalog.catalog', [
            'categories' => $categories,
            'products' => $products->orderBy('products.id')->paginate(10),
            'filters' => $filters,]);
    }
}
