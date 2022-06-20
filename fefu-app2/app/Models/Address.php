<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


/**
 * App\Models\Address
 *
 * @property int $id
 * @property string $city
 * @property string $street
 * @property string $house
 * @property string|null $apartment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\AddressFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereApartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereHouse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'street',
        'house',
        'apartment'
    ];

    /**
     * @param Request $request
     * @return mixed
     */
    public static function storeFromRequest(Request $request)
    {
        return self::create([
            'city' => $request->input('delivery_address')['city'],
            'street' => $request->input('delivery_address')['street'],
            'house' => $request->input('delivery_address')['house'],
            'apartment' => $request->input('delivery_address')['apartment'] ?? null,
        ]);
    }
}
