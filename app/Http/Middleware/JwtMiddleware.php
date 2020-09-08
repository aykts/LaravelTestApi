<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponserTrait;
use Closure;
use Exception;
use JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Http\JsonResponse;

class JwtMiddleware extends BaseMiddleware
{
    use ApiResponserTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return $this->fail(
                    'User Not Found',
                    '',
                    JsonResponse::HTTP_NOT_FOUND
                );
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->fail($e->getMessage());
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this->fail(
                    $e->getMessage(),
                    '',
                    JsonResponse::HTTP_UNAUTHORIZED
                );
            } else {
                return $this->fail(
                    'Authorization Token not found',
                    '',
                    JsonResponse::HTTP_NOT_FOUND
                );
            }
        }
        return $next($request);
    }
}
