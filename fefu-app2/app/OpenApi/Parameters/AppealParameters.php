<?php

namespace App\OpenApi\Parameters;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class AppealParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::query()
                ->name('name')
                ->description('Name')
                ->required(true)
                ->schema(Schema::string())
                ->example('UserName'),
            Parameter::query()
                ->name('phone')
                ->description('Phone')
                ->required(false)
                ->schema(Schema::string())
                ->example('+79991112233'),
            Parameter::query()
                ->name('email')
                ->description('Email')
                ->required(false)
                ->schema(Schema::string())
                ->example('Woof@email.com'),
            Parameter::query()
                ->name('message')
                ->description('Message')
                ->required(true)
                ->schema(Schema::string())
                ->example('SomeTextHere'),

        ];
    }
}
