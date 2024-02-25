<?php

namespace Modules\Product\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Product\Entities\Contracts\ProductInterface;

interface ProductRepositoryInterface
{
    /**
     *
     */
    public function model(): Model;

    /**
     *
     */
    public function getAll(): Collection;

    /**
     *
     */
    public function getAllPaginated(): LengthAwarePaginator;

    /**
     *
     */
    public function getById(int $id): ProductInterface;

    /**
     *
     */
    public function store(array $input): ProductInterface;

    /**
     *
     */
    public function update(array $input, int $id): ProductInterface;

    /**
     *
     */
    public function destroy(int $id): bool;
}
