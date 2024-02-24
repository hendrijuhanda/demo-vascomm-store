<?php

namespace Modules\User\Entities\Contracts;

use Laravel\Passport\HasApiTokens;

interface UserInterface
{
    const TABLE = 'users';

    /**
     *
     */
    public function getId(): int;

    /**
     *
     */
    public function getFullName(): string;

    /**
     *
     */
    public function getEmail(): string;

    /**
     *
     */
    public function getPhoneNumber(): string;

    /**
     *
     */
    public function getIsActive(): bool;

    /**
     * Create a new personal access token for the user.
     *
     * @param  string  $name
     * @param  array  $scopes
     * @return \Laravel\Passport\PersonalAccessTokenResult
     */
    public function createToken($name, array $scopes = []);

    /**
     * Assign the given role to the model.
     *
     * @param  string|int|array|Role|Collection|\BackedEnum  ...$roles
     * @return $this
     */
    public function assignRole(...$roles);
}
