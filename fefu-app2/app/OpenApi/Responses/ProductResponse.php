<?php

namespace App\OpenApi\Responses;

use App\OpenApi\Schemas\DetailedProductSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema as ObjectsSchema;

class ProductResponse extends ResponseFactory
{
    /**
     * @return Response
     */
    public function build(): Response
    {
        return Response::ok()->description('Successful response')->content(
            MediaType::json()->schema(
                ObjectsSchema::object()->properties(
                    ObjectsSchema::array('data')->items(DetailedProductSchema::ref()),
                )
            )
        );
    }
}
