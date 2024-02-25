<?php

namespace Modules\Client\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Modules\Client\Services\Contracts\ClientProductServiceInterface;
use Modules\Product\Http\Resources\ProductResource;

class ClientProductController extends ClientController
{
    private ClientProductServiceInterface $clientProductService;

    public function __construct(ClientProductServiceInterface $clientProductService)
    {
        $this->clientProductService = $clientProductService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->jsonResponse(
            [$this->clientProductService->index(), ProductResource::class],
            Response::HTTP_OK
        );
    }
}
