<?php

namespace App\Http\Controllers;

use App\Http\Resources\PageResources;
use Illuminate\Contracts\Support\Responsable;
use App\Models\Page;
use \App\OpenApi\Responses\ShowPageResponse;
use \App\OpenApi\Responses\ListPageResponse;
use \App\OpenApi\Responses\NotFoundResponse;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class PageApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Responsable
     */
    #[OpenApi\Operation]
    #[OpenApi\Response(factory: ListPageResponse::class, statusCode: 200)]
    public function index()
    {
        return PageResources::collection(
            Page::query()->paginate(5)
        );
    }


    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return Responsable
     */
    #[OpenApi\Operation]
    #[OpenApi\Response(factory: ShowPageResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: NotFoundResponse::class, statusCode: 200)]
    public function show(string $slug)
    {
        return new PageResources(
            Page::query()->where('slug', $slug)->firstOrFail()
        );
    }
}
