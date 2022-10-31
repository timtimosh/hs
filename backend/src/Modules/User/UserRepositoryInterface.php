<?php

declare(strict_types=1);

namespace HotsaleApi\Modules\User;

interface UserRepositoryInterface
{
    public function exists(string $userEmail):bool;

    public function fetch():array;
}