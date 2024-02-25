<?php

namespace Modules\User\Services\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\User\Entities\Contracts\UserInterface;

interface UserServiceInterface
{
    /**
     *
     */
    public function index(): LengthAwarePaginator;

    /**
     *
     */
    public function show(int $id): UserInterface;

    /**
     *
     */
    public function create(array $input): UserInterface;

    /**
     *
     */
    public function update(array $input, int $id): UserInterface;

    /**
     *
     */
    public function delete(int $id): bool;

    /**
     *
     */
    public function authenticate(string $emailOrPhone, string $password): UserInterface|null;

    /**
     *
     */
    public function register(array $input): UserInterface;
}
