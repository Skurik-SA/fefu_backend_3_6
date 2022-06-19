<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductWebController extends Controller
{
    public function index(string $slug)
    {
        $product = Product::query()
            ->with('productCategory', 'sortedAttributeValues.productAttribute')
            ->where('slug', $slug)
            ->first();
        if ($product === null){
            abort(404);
        }

        return view('products.index', ['product' => $product]);
    }
}
