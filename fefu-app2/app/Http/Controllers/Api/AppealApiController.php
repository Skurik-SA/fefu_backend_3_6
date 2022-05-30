<?php

namespace App\Http\Controllers\Api;

use \App\OpenApi\Responses\ErrorValidationResponse;
use \App\OpenApi\Responses\SuccessValidationResponse;
use \App\OpenApi\Parameters\AppealParameters;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppealApiRequest;
use App\Http\Requests\StoreAppealRequest;
use App\Http\Requests\UpdateAppealRequest;
use App\Models\Appeal;
use App\Sanitizers\PhoneSanitizer;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class AppealApiController extends Controller
{
    /**
     * Save appeal submitted data
     * @param AppealApiRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    #[OpenApi\Operation(tags: ['appeal'], method: 'POST')]
    #[OpenApi\Parameters(factory: AppealParameters::class)]
    #[OpenApi\Response(factory: SuccessValidationResponse::class, statusCode: 200)]
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
