<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     *
     */
    protected function jsonResponse($data, int $status, $message = 'Success.'): JsonResponse
    {
        if ($data instanceof LengthAwarePaginator) {
            return response()->json([
                'code' => $status,
                'message' => $message,
                'data' => [
                    'items' => $data->items(),
                    'pagination' => [
                        'current_page' => $data->currentPage(),
                        'per_page' => $data->perPage(),
                        'total' => $data->total(),
                        'count' => $data->count(),
                        'total_pages' => $data->lastPage()
                    ]
                ]
            ], $status);
        }

        return response()->json([
            'code' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}
