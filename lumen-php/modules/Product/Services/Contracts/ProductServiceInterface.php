<?php

namespace Modules\Product\Services\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Product\Entities\Contracts\ProductInterface;

interface ProductServiceInterface
{
    /**
     *
     */
    public function index(): LengthAwarePaginator;

    /**
     *
     */
    public function show(int $id): ProductInterface;

    /**
     *
     */
    public function create(array $input): ProductInterface;

    /**
     *
     */
    public function update(array $input, int $id): ProductInterface;

    /**
     *
     */
    public function delete(int $id): bool;
}
