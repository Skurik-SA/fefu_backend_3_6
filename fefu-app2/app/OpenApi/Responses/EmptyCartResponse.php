<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class EmptyCartResponse extends ResponseFactory
{
    /**
     * @return Response
     */
    public function build(): Response
    {
        return Response::ok()->description('Cart is empty');
    }
}
