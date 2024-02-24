<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Entities\Contracts\ProductInterface;

class Product extends Model implements ProductInterface
{
    use HasFactory, SoftDeletes;

    protected $table = self::TABLE;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'price', 'image', 'is_active',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'image', 'deleted_at'
    ];

    protected $appends = ['image_url'];

    /**
     * @inheritdoc
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @inheritdoc
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @inheritdoc
     */
    public function getIsActive(): bool
    {
        return $this->is_active;
    }

    public function getImageUrlAttribute(): string
    {
        return request()->getSchemeAndHttpHost() . '/' . $this->image;
    }
}
