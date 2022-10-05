<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * responseSuccess
     *
     * @param  array $data
     * @param  int   $statusCode 2xx : 200, 201
     * @param  null|string $masterKey Master key of response
     * @return JsonResponse
     */
    public function responseSuccess($data = [], $statusCode = 200, $masterKey = null)
    {
        if (!empty($masterKey)) {
            $data = is_null($data) ? [] : $data;
            $response[$masterKey] = $data;
            return response()->json($response, $statusCode);
        }
        return response()->json($data, $statusCode);
    }

    /**
     * responseError
     *
     * @param  string $message
     * @param  int $statusCode
     * @return void
     */
    public function responseError($message, $statusCode)
    {
        $jsonOut = [
            'message' => $message,
        ];
        return response()->json($jsonOut, $statusCode);
    }
}
