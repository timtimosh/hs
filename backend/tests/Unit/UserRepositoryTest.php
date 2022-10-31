<?php

declare(strict_types=1);

namespace Tests\Unit;

use HotsaleApi\Modules\User\UserRepository;
use PHPUnit\Framework\TestCase;

final class UserRepositoryTest extends TestCase
{
    private static UserRepository $userRepository;
    private static array          $inMemoryUsers = [
        ['id' => 1, 'email' => 'test1@gmail.com', 'name' => 'u1'],
        ['id' => 2, 'email' => 'test2@gmail.com', 'name' => 'u2'],
        ['id' => 3, 'email' => 'test3@gmail.com', 'name' => 'u3'],
    ];

    public static function setUpBeforeClass(): void
    {
        self::$userRepository = new UserRepository(self::$inMemoryUsers);
    }

    public function testExists(): void
    {
        self::assertFalse(self::$userRepository->exists('mrtimosh@gmail.com'));
        self::assertTrue(self::$userRepository->exists('test3@gmail.com'));
        self::assertTrue(self::$userRepository->exists('test1@gmail.com'));
    }
}
