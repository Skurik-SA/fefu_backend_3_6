<?php

namespace App\OpenApi\Parameters;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class LoginSubmitParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('email')
                ->description('Field with email-address')
                ->required(true)
                ->schema(Schema::string())
                ->example("Woof@woof.com"),
            Parameter::query()
                ->name('password')
                ->description('Field with password')
                ->required(true)
                ->schema(Schema::string()->minLength(1)->maxLength(255))
                ->example("woof_2022"),
        ];
    }
}
