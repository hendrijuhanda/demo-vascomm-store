<?php

namespace Modules\User\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\User\Entities\Contracts\UserInterface;
use Modules\User\Entities\User;
use Modules\User\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function getAll(): Collection
    {
        return User::all();
    }

    /**
     * @inheritdoc
     */
    public function getAllPaginated(): LengthAwarePaginator
    {
        return User
            ::with('roles:name')

            ->when(request()->get('full_name'), function ($q) {
                return $q->where('full_name', 'like', '%' . request()->get('full_name') . '%');
            })

            ->when(request()->get('email'), function ($q) {
                return $q->where('email', 'like', '%' . request()->get('email') . '%');
            })

            ->when(request()->get('phone_number'), function ($q) {
                return $q->where('phone_number', 'like', '%' . request()->get('phone_number') . '%');
            })

            ->when(request()->get('is_active'), function ($q) {
                return $q->where('is_active', request()->get('is_active'));
            })

            ->paginate(request()->get('per_page'), ['*'], null, request()->get('page'));
    }

    /**
     * @inheritdoc
     */
    public function getById(int $id): UserInterface
    {
        return User::findOrFail($id);
    }

    /**
     * @inheritdoc
     */
    public function store(array $input): UserInterface
    {
        return User::create($input);
    }

    /**
     * @inheritdoc
     */
    public function update(array $input, int $id): UserInterface
    {
        $record = User::findOrFail($id);

        $record->update($input);

        return $record->fresh();
    }

    /**
     * @inheritdoc
     */
    public function destroy(int $id): bool
    {
        $record = User::findOrFail($id);

        return $record->delete();
    }
}
