<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('checkout.index', [
            'user' => Auth::user()
        ]);
    }

    /**
     * @param OrderStoreRequest $request
     * @return Application|RedirectResponse|Redirector
     * @throws \Exception
     */
    public function store(OrderStoreRequest $request)
    {
        $address = null;
        if (!self::containsOnlyNull($request->input('delivery_address'))) {
            $address = Address::storeFromRequest($request);
        }

        $cart = Cart::getOrCreateCart($request->user(), null);

        if ($cart->isEmpty()) {
            return back()->withErrors([
                '' => 'cart is empty'
            ]);
        }

        $cart->user_id = null;
        $cart->session_id = null;
        $cart->save();

        Order::storeFromRequest($request, $address, $cart);

        return redirect(route('profile'));
    }

    /**
     * @param $input
     * @return bool
     */
    private function containsOnlyNull($input)
    {
        return empty(array_filter($input, function ($a) { return $a !== null;}));
    }
}
