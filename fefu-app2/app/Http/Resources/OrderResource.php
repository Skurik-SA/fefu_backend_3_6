<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/** @mixin Order */
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'customerName' => $this->customer_name,
            'customerEmail' => $this->customer_email,
            'deliveryType' => $this->delivery_type,
            'paymentMethod' => $this->payment_method,
            'address' => AddressResource::make($this->address)
        ];
    }
}
