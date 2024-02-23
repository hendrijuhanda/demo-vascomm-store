<?php

namespace Modules\Product\Entities\Contracts;

interface ProductInterface
{
    const TABLE = 'products';

    /**
     *
     */
    public function getId(): int;

    /**
     *
     */
    public function getName(): string;

    /**
     *
     */
    public function getPrice(): float;

    /**
     *
     */
    public function getImage(): string;

    /**
     *
     */
    public function getIsActive(): bool;
}
