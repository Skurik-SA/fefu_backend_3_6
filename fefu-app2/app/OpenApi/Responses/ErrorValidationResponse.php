<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ErrorValidationResponse extends ResponseFactory
{
    /**
     * @return Response
     */
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::object('message')->example('Invalid Data.'),
            Schema::object('errors')->additionalProperties(
                Schema::array()->items(Schema::string())
            )->example(['field' => ['Something went wrong!']])
        );

        return Response::create('ErrorValidation')->description('Validation errors')
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
