<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    /**
     * Mengembalikan respons JSON sukses standar.
     *
     * @param mixed $data Data utama yang ingin dikembalikan (array/object)
     * @param string|null $message Pesan sukses untuk frotend/klien
     * @param int $code Status HTTP Code (default: 200 OK)
     * @return JsonResponse
     */
    protected function success($data = null, $message = null, $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ], $code);
    }

    /**
     * Mengembalikan respons JSON gagal/error standar.
     *
     * @param string|null $message Pesan error atau kegagalan sistem
     * @param int $code Status HTTP Code (default: 400 Bad Request)
     * @return JsonResponse
     */
    protected function error($message = null, $code = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $code);
    }
}