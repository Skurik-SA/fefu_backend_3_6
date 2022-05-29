<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResources;
use App\Models\News;
use Illuminate\Contracts\Support\Responsable;
use \App\OpenApi\Responses\ShowNewsResponse;
use \App\OpenApi\Responses\ListNewsResponse;
use \App\OpenApi\Responses\NotFoundResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class NewsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Responsable
     */
    #[OpenApi\Operation]
    #[OpenApi\Response(factory: ListNewsResponse::class, statusCode: 200)]
    public function index()
    {
        return NewsResources::collection(
            News::query()->published()->paginate(5)
        );
    }


    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return Responsable
     */
    #[OpenApi\Operation]
    #[OpenApi\Response(factory: ShowNewsResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: NotFoundResponse::class, statusCode: 200)]
    public function show(string $slug)
    {
        return new NewsResources(
            News::query()->published()->where('slug', $slug)->firstOrFail()
        );
    }

}
