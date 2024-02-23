<?php

namespace Modules\User\Entities\Contracts;

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
}
