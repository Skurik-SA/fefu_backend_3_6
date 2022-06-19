<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string|null $slug
     * @return Application|Factory|View
     */
    public function index(string $slug = null)
    {
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
            abort(422, $exception->getMessage());
        }

        return view('catalog.catalog', ['categories' => $categories, 'products' => $products]);
    }
}
