<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartModificationRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\OpenApi\Responses\ShowCartResponse;
use App\OpenApi\Responses\CartErrorValidationResponse;
use Illuminate\Support\Facades\Auth;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class CartController extends Controller
{

    /**
     * @param CartModificationRequest $request
     * @return CartResource
     */
    #[OpenApi\Operation(tags: ['cart'], method: 'POST')]
    #[OpenApi\Response(factory: ShowCartResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: CartErrorValidationResponse::class, statusCode: 422)]
    public function set_quantity(CartModificationRequest $request): CartResource
    {
        $data = $request->validated('modifications');

        /** @var User $user */
        $user = Auth::user();

        $sessionId = session()->getId();
        $cart = Cart::getOrCreateCart($user, $sessionId);

        $productIds = array_column($data, 'product_id');
        $productsById = Product::whereIn('id', $productIds)->get()->keyBy('id');

        foreach ($data as $modification) {
            $cart->setProductQuantity($productsById[$modification['product_id']], $modification['quantity']);
        }
        $cart->recalculateCart();
        $cart->save();

        return CartResource::make($cart);
     }

    /**
     * @return CartResource
     */
    #[OpenApi\Operation(tags: ['cart'], method: 'GET')]
    #[OpenApi\Response(factory: ShowCartResponse::class, statusCode: 200)]
    public function show(): CartResource
    {
        /** @var User $user */
        $user = Auth::user();
        return CartResource::make(Cart::getOrCreateCart($user, session()->getId()));
    }
}
