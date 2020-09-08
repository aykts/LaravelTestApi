<?php
/**
 * Created by PhpStorm.
 * User: AykutPC
 * Date: 21.8.2020
 * Time: 02:08
 */

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponserTrait
{
    /**
     * @param $data
     * @param null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function ok($data, $message = null, $code = JsonResponse::HTTP_OK) : JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
            'error' => null,
        ], $code);
    }

    /**
     * @param $data
     * @param null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function fail($data, $message = null, $code = JsonResponse::HTTP_BAD_REQUEST) : JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => null,
            'error' => $data,
        ], $code);
    }
}
