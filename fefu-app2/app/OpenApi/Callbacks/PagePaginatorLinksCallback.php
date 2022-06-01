<?php

namespace App\OpenApi\Callbacks;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Operation;
use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\CallbackFactory;

class PagePaginatorLinksCallback extends CallbackFactory
{
    public function build(): PathItem
    {
        return PathItem::create('MyEvent')
            ->route('{$request.body#/callbackUrl}')
            ->operations(
                Operation::post()
                    ->requestBody(
                        RequestBody::create()
                            ->description('something happened')
                            ->content(
                                MediaType::json()->schema(
                                    Schema::object()
                                        ->properties(
                                            Schema::string('foo')
                                        )
                                )
                            )
                    )
                    ->responses(
                        Response::ok()->description('Your server returns this code if it accepts the callback')
                    )
            );
    }
}
