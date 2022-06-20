<?php

namespace App\Models;

use App\Enums\OrderDeliveryType;
use App\Enums\OrderPaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;


/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $address_id
 * @property int $cart_id
 * @property string $customer_name
 * @property string $customer_email
 * @property int $delivery_type
 * @property int $payment_method
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Address|null $address
 * @method static \Database\Factories\OrderFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'delivery_type',
        'payment_method',
        'address_id',
        'cart_id'
    ];

    /**
     * @param Request $request
     * @param Address|null $address
     * @param Cart $cart
     * @return mixed
     */
    public static function storeFromRequest(Request $request, ?Address $address, Cart $cart)
    {
        $deliveryTypeEnums = OrderDeliveryType::getConstants();
        $paymentMethodEnums = OrderPaymentMethod::getConstants();
        $user = $request->user();

        return self::create([
            'user_id' => $user->id,
            'address_id' => $address->id,
            'cart_id' => $cart->id,
            'customer_name' => $request->input('customer_name'),
            'customer_email' => $request->input('customer_email'),
            'delivery_type' => $deliveryTypeEnums[strtoupper($request->input('delivery_type'))],
            'payment_method' => $paymentMethodEnums[strtoupper($request->input('payment_method'))],
        ]);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
