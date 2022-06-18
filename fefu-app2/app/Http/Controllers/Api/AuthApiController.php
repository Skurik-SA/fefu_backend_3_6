<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginApiRequest;
use App\Http\Requests\RegistrationApiRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\OpenApi\Responses\UserResponse;
use App\OpenApi\Responses\UserTokenResponse;
use App\OpenApi\Responses\UserLogoutResponse;
use App\OpenApi\Responses\ErrorValidationResponse;
use App\OpenApi\Parameters\LoginSubmitParameters;
use App\OpenApi\Parameters\RegistrationSubmitParameters;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class AuthApiController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    #[OpenApi\Operation(tags: ['auth'])]
    #[OpenApi\Response(factory: UserResponse::class, statusCode: 200)]
    public function user(Request $request)
    {
        return $request->user();
    }

    /**
     * @param LoginApiRequest $request
     * @method POST
     * @return JsonResponse
     */
    #[OpenApi\Operation(tags: ['auth'], method: 'POST')]
    #[OpenApi\Parameters(factory: LoginSubmitParameters::class)]
    #[OpenApi\Response(factory: UserTokenResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: ErrorValidationResponse::class, statusCode: 422)]
    public function login(LoginApiRequest $request)
    {
        $data = $request->validated();

        if (!Auth::attempt($data, true))
        {
            return response()->json([
                'message' => 'The given data was invalid',
                'errors' => [
                    'email' => 'invalid email',
                    'password' => 'invalid password',
                ]
            ], 422);
        }

        /** @var $user User */
        $user = Auth::user();
        $authToken = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'access_token' => $authToken,
        ], 200);
    }

    /**
     * @param Request $request
     * @method POST
     * @return JsonResponse
     */
    #[OpenApi\Operation(tags: ['auth'], method: 'POST')]
    #[OpenApi\Response(factory: UserLogoutResponse::class, statusCode: 200)]
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'Successfully logout',
        ], 200);
    }

    /**
     * @param RegistrationApiRequest $request
     * @method POST
     * @return JsonResponse
     */
    #[OpenApi\Operation(tags: ['auth'], method: 'POST')]
    #[OpenApi\Parameters(factory: RegistrationSubmitParameters::class)]
    #[OpenApi\Response(factory: UserTokenResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: ErrorValidationResponse::class, statusCode: 422)]
    public function registration(RegistrationApiRequest $request)
    {
        $data = $request->validated();
        $user = User::createFromRequest($data);

        $authToken = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'access_token' => $authToken,
        ], 200);
    }
}
