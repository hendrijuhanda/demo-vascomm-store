<?php

namespace Modules\User\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\User\Entities\Contracts\UserInterface;

interface UserRepositoryInterface
{
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
    public function getById(int $id): UserInterface;

    /**
     *
     */
    public function store(array $input): UserInterface;

    /**
     *
     */
    public function update(array $input, int $id): UserInterface;

    /**
     *
     */
    public function destroy(int $id): bool;
}
