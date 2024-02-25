<?php

namespace Modules\Client\Services\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface ClientProductServiceInterface
{
    /**
     *
     */
    public function index(): LengthAwarePaginator;
}
