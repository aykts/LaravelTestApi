<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 21.8.2020
 * Time: 10:34
 */

namespace App\Traits;

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

trait ExceptionTrait
{

    use ApiResponserTrait;

    public function apiException($request, $e)
    {
        if ($this->isModel($e)) {
            $modelClass = explode('\\', $e->getModel());
            return $this->fail(
                'Model '.end($modelClass).' not found',
                '',
                JsonResponse::HTTP_UNAUTHORIZED
            );
        } elseif ($this->isTokenExpired($e)) {
            return $this->fail(
                $e->getMessage(),
                '',
                JsonResponse::HTTP_UNAUTHORIZED
            );
        } elseif ($this->isHttp($e)) {
            return $this->fail(
                __('global.404'),
                '',
                JsonResponse::HTTP_NOT_FOUND
            );
        } elseif ($this->isMethod($e)) {
            return $this->fail(
                $e->getMessage(),
                '',
                JsonResponse::HTTP_METHOD_NOT_ALLOWED
            );
        } elseif ($this->isValidate($e)) {
            return $this->fail(
                $e->validator->getData(),
                '',
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        } elseif ($this->isQuery($e)) {
            $errorMessage = ($e->errorInfo == null)? $e->getMessage() : end($e->errorInfo);

            return $this->fail(
                $errorMessage,
                '',
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        } else {
            return $this->fail(
                $e->getMessage(),
                '',
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    protected function isTokenExpired($e)
    {
        return $e instanceof TokenExpiredException;
    }

    protected function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    protected function isValidate($e)
    {
        return $e instanceof ValidationException;
    }

    protected function isHttp($e)
    {
        return $e instanceof NotFoundHttpException;
    }

    protected function isMethod($e)
    {
        return $e instanceof MethodNotAllowedHttpException;
    }

    protected function isQuery($e)
    {
        return $e instanceof QueryException ;
    }
}
