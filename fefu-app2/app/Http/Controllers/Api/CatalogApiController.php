<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CatalogResources;
use App\Models\ProductCategory;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use App\OpenApi\Responses\CatalogResponse;
use App\OpenApi\Responses\ShowCatalogResponse;
use App\OpenApi\Responses\NotFoundResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class CatalogApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Responsable
     */
    #[OpenApi\Operation(tags: ['catalog'])]
    #[OpenApi\Response(factory: CatalogResponse::class, statusCode: 200)]
    public function index()
    {
        return CatalogResources::collection(
            ProductCategory::all(),
        );
    }


    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return Responsable
     */
    #[OpenApi\Operation(tags: ['catalog'])]
    #[OpenApi\Response(factory: ShowCatalogResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: NotFoundResponse::class, statusCode: 404)]
    public function show(string $slug)
    {
        return new CatalogResources(
            ProductCategory::query()->where('slug', $slug)->firstOrFail()
        );
    }

}
