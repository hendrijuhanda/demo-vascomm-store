<?php

namespace Modules\User\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\User\Entities\Contracts\UserInterface;
use Modules\User\Repositories\Contracts\UserRepositoryInterface;
use Modules\User\Services\Contracts\UserServiceInterface;

class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritdoc
     */
    public function index(): LengthAwarePaginator
    {
        return $this->userRepository->getAllPaginated();
    }

    /**
     * @inheritdoc
     */
    public function show(int $id): UserInterface
    {
        return $this->userRepository->getById($id);
    }

    /**
     * @inheritdoc
     */
    public function create(array $input): UserInterface
    {
        return $this->userRepository->store($input);
    }

    /**
     * @inheritdoc
     */
    public function update(array $input, int $id): UserInterface
    {
        return $this->userRepository->update($input, $id);
    }

    /**
     * @inheritdoc
     */
    public function delete(int $id): bool
    {
        return $this->userRepository->destroy($id);
    }
}
