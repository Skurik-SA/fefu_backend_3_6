<?php

namespace App\OpenApi\Schemas;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AnyOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Not;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\SchemaFactory;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;

class DetailedProductSchema extends SchemaFactory implements Reusable
{
    /**
     * @return SchemaContract
     */
    public function build(): SchemaContract
    {
        return Schema::object('Product')
            ->properties(
                Schema::string('name')->default(null),
                Schema::string('description')->default(null),
                Schema::number('price')->format('double'),
                Schema::array('characteristics')->items(
                    Schema::object()->properties(
                        Schema::string('name')->nullable(null),
                        Schema::string('value')->nullable(null),
                    )
                )
            );
    }
}
