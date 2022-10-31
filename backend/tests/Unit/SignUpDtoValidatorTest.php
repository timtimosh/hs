<?php

declare(strict_types=1);

namespace Tests\Unit;

use HotsaleApi\Modules\User\SignUpDto;
use HotsaleApi\Modules\User\SignUpDtoValidator;
use HotsaleApi\Exception\ValidationException;
use PHPUnit\Framework\TestCase;

final class SignUpDtoValidatorTest extends TestCase
{
    public function testOk(): void
    {
        $dto = SignUpDto::fromArray(
            [
                'userName'            => 'N1',
                'userSurname'         => 'S1',
                'userEmail'           => 'uns1@gmail.com',
                'userPassword'        => 'p1',
                'userConfirmPassword' => 'p1',
            ]
        );
        self::assertNull(SignUpDtoValidator::validate($dto));
    }

    public function testValidateEmail(): void
    {
        $this->expectException(ValidationException::class);
        $dto = SignUpDto::fromArray(
            [
                'userName'            => 'N1',
                'userSurname'         => 'S1',
                'userEmail'           => 'uns1gmail.com',
                'userPassword'        => 'p1',
                'userConfirmPassword' => 'p2',
            ]
        );
        SignUpDtoValidator::validate($dto);
    }

    public function testValidatePswd(): void
    {
        $this->expectException(ValidationException::class);
        $dto = SignUpDto::fromArray(
            [
                'userName'            => 'N1',
                'userSurname'         => 'S1',
                'userEmail'           => 'uns1gmail.com',
                'userPassword'        => 'p1',
                'userConfirmPassword' => 'p1',
            ]
        );
        SignUpDtoValidator::validate($dto);
    }
}
