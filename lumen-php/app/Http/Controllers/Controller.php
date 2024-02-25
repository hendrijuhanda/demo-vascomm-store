<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
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
        } else if (is_array($data) && $data[0] instanceof LengthAwarePaginator && class_exists($data[1])) {
            $collection = $data[0];
            $class = $data[1];

            return response()->json([
                'code' => $status,
                'message' => $message,
                'data' => [
                    'items' => $class::collection($collection),
                    'pagination' => [
                        'current_page' => $collection->currentPage(),
                        'per_page' => $collection->perPage(),
                        'total' => $collection->total(),
                        'count' => $collection->count(),
                        'total_pages' => $collection->lastPage()
                    ]
                ]
            ], $status);
        } else if (is_array($data) && class_exists($data[1])) {
            $collection = $data[0];
            $class = $data[1];

            $result = (new $class($collection))->toArray(null);

            if (isset($data[2]) && is_array($data[2])) {
                $result = array_merge($result, $data[2]);
            }

            return response()->json([
                'code' => $status,
                'message' => $message,
                'data' => $result
            ], $status);
        }

        return response()->json([
            'code' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}
