<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\CatalogFormRequest;
use App\Models\ProductCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Exception;

class CatalogController extends Controller
{
    const B_PAGES = 10;

    /**
     * Display a listing of the resource.
     *
     * @param CatalogFormRequest $request
     * @param null $slug
     * @return Application|Factory|View
     */
    public function index(CatalogFormRequest $request, $slug = null): View|Factory|Application
    {
        $requestData = $request->validated();

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
            'products' => $products->orderBy('products.id')->paginate(self::B_PAGES),
            'filters' => $filters,]);
    }
}