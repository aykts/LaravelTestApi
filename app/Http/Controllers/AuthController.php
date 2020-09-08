<?php

namespace App\Http\Controllers;

use App\Core\BaseController;
use App\Http\Requests\Auth\LoginRequest;
use App\Traits\ApiResponserTrait;
use Laravel\Passport\Passport;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    use ApiResponserTrait;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request) : JsonResponse
    {
        $credentials = $request->only('email', 'password');


        if (Auth::guard()->attempt($credentials)) {
            $access_token = Auth::user()->createToken('authToken')->accessToken;
            return $this->ok(
                [
                    'access_token' => $access_token,
                    'token_type' => 'bearer',
                    'expires_in' => now()->addDay(Passport::tokensExpireIn()->days)->format('Y-m-d H:i:s'),
                ]
            );
        }

        return $this->fail(
            __('auth.failed'),
            '',
            JsonResponse::HTTP_UNAUTHORIZED
        );
    }

    public function refresh()
    {
        $http = new \GuzzleHttp\Client;

        $response = $http->post('/oauth/token', [
            'form_params' => [
                "grant_type" => "refresh_token",
                "refresh_token" => "",
                "client_id" => "",
                "client_secret" => "",
                "scope" => "*",
            ],
        ]);


        return response()->json((string)$response->getBody());
    }
}
