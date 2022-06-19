<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use App\OpenApi\Schemas\ListProductSchema ;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use App\OpenApi\Schemas\PaginatorLinksSchema;
use App\OpenApi\Schemas\PaginatorMetaSchema;

class ProductsListResponse extends ResponseFactory
{
    /**
     * @return Response
     */
    public function build(): Response
    {
        return Response::ok()->description('Successful response')->content(
            MediaType::json()->schema(
                Schema::object()->properties(
                    Schema::array('data')->items(ListProductSchema::ref()),
                    PaginatorLinksSchema::ref('links'),
                    PaginatorMetaSchema::ref('meta'),
                )
            )
        );
    }
}
