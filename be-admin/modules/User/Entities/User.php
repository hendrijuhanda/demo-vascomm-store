<?php

namespace Modules\User\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;
use Modules\User\Entities\Contracts\UserInterface;
use Spatie\Permission\Traits\HasRoles;

class User extends Model implements AuthenticatableContract, AuthorizableContract, UserInterface
{
    use Authenticatable, Authorizable, HasFactory, SoftDeletes, HasRoles;

    protected $table = self::TABLE;

    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'full_name', 'email', 'phone_number', 'is_active',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password', 'deleted_at'
    ];

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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @inheritdoc
     */
    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    /**
     * @inheritdoc
     */
    public function getIsActive(): bool
    {
        return $this->is_active;
    }
}
