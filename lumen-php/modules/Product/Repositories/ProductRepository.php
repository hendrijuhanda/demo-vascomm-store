<?php

namespace Modules\Product\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Modules\Product\Entities\Contracts\ProductInterface;
use Modules\Product\Entities\Product;
use Modules\Product\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function model(): Model
    {
        return new Product;
    }

    /**
     * @inheritdoc
     */
    public function getAll(): Collection
    {
        return Product::all();
    }

    /**
     * @inheritdoc
     */
    public function getAllPaginated(): LengthAwarePaginator
    {
        return Product
            ::when(request()->get('name'), function ($q) {
                return $q->where('name', 'like', '%' . request()->get('name') . '%');
            })

            ->when(request()->get('is_active'), function ($q) {
                return $q->where('is_active', request()->get('is_active'));
            })

            ->paginate(request()->get('per_page'), ['*'], null, request()->get('page'));
    }

    /**
     * @inheritdoc
     */
    public function getById(int $id): ProductInterface
    {
        return Product::findOrFail($id);
    }

    /**
     * @inheritdoc
     */
    public function store(array $input): ProductInterface
    {
        return Product::create($input);
    }

    /**
     * @inheritdoc
     */
    public function update(array $input, int $id): ProductInterface
    {
        return DB::transaction(function () use ($input, $id) {
            $record = Product::findOrFail($id);

            $oldImage = $record->image;

            $record->update($input);

            if (isset($input['image'])) {
                File::delete($oldImage);
            }

            return $record->fresh();
        });
    }

    /**
     * @inheritdoc
     */
    public function destroy(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $record = Product::findOrFail($id);

            if (File::exists($record->image)) {
                File::delete($record->image);
            }

            return $record->delete();
        });
    }
}
