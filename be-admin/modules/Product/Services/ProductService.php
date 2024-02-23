<?php

namespace Modules\Product\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Product\Entities\Contracts\ProductInterface;
use Modules\Product\Repositories\Contracts\ProductRepositoryInterface;
use Modules\Product\Services\Contracts\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @inheritdoc
     */
    public function index(): LengthAwarePaginator
    {
        return $this->productRepository->getAllPaginated();
    }

    /**
     * @inheritdoc
     */
    public function show(int $id): ProductInterface
    {
        return $this->productRepository->getById($id);
    }

    /**
     * @inheritdoc
     */
    public function create(array $input): ProductInterface
    {
        return $this->productRepository->store($input);
    }

    /**
     * @inheritdoc
     */
    public function update(array $input, int $id): ProductInterface
    {
        return $this->productRepository->update($input, $id);
    }

    /**
     * @inheritdoc
     */
    public function delete(int $id): bool
    {
        return $this->productRepository->destroy($id);
    }
}
