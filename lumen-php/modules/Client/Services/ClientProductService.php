<?php

namespace Modules\Client\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Client\Services\Contracts\ClientProductServiceInterface;
use Modules\Product\Repositories\Contracts\ProductRepositoryInterface;

class ClientProductService implements ClientProductServiceInterface
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     *
     */
    public function index(): LengthAwarePaginator
    {
        if (request()->get('sort')) {
            $arr = explode(',', request()->get('sort'));

            $field = $arr[0];
            $dir = $arr[1];
        }

        return $this->productRepository->model()
            ->where('is_active', 1)

            ->when(request()->get('name'), function ($q) {
                return $q->where('name', 'like', '%' . request()->get('name') . '%');
            })

            ->when($field && $dir, function ($q) use ($field, $dir) {
                return $q->orderBy($field, $dir);
            })

            ->paginate(request()->get('per_page'), ['*'], null, request()->get('page'));
    }
}
