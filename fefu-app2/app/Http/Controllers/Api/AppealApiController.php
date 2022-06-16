<?php

namespace App\Http\Controllers\Api;

use \App\OpenApi\Responses\ErrorValidationResponse;
use \App\OpenApi\Responses\EmptyResponse;
use \App\OpenApi\Parameters\AppealSubmitParameters;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppealApiRequest;
use App\Models\Appeal;
use App\Sanitizers\PhoneSanitizer;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class AppealApiController extends Controller
{
    /**
     * Save appeal submitted data
     * @param AppealApiRequest $request
     * @return JsonResponse
     */
    #[OpenApi\Operation(tags: ['appeal'], method: 'POST')]
    #[OpenApi\Parameters(factory: AppealSubmitParameters::class)]
    #[OpenApi\Response(factory: EmptyResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: ErrorValidationResponse::class, statusCode: 422)]
    public function store(AppealApiRequest $request)
    {
        $data = $request->validated();

        $appeal = new Appeal();
        $appeal->name = $data['name'];
        $appeal->phone = PhoneSanitizer::sanitize($data['phone']??null);
        $appeal->email = $data['email']??null;
        $appeal->message = $data['message'];
        $appeal->save();

        return response()->json([
            'message'=>'Success'
        ], 200);
    }
}
