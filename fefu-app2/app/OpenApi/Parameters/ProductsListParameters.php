<?php

namespace App\OpenApi\Parameters;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema as ObjectsSchema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class ProductsListParameters extends ParametersFactory {
    /**
     * @return Parameter[]
     */
    public function build(): array {
        return [
            Parameter::query()
                ->name('category_slug')
                ->required(false)
                ->schema(ObjectsSchema::string()),
        ];
    }
}
