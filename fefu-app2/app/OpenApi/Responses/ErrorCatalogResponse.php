<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class ErrorCatalogResponse extends ResponseFactory
{
    /**
     * @return Response
     */
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('message')->example('Error'),
            Schema::string('errors')->example('error category'),
        );

        return Response::create('Error_category')
            ->description('Category error')
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
