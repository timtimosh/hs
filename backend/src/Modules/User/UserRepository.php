<?php

declare(strict_types=1);

namespace HotsaleApi\Modules\User;

final class UserRepository implements UserRepositoryInterface
{
    private array $inMemoryUsers;

    public function __construct(array $inMemoryUsers)
    {
        $this->inMemoryUsers = $inMemoryUsers;
    }

    public function exists(string $userEmail): bool
    {
        return in_array($userEmail, array_column($this->inMemoryUsers, 'email'), true);
    }

    public function fetch(): array
    {
        return $this->inMemoryUsers;
    }
}