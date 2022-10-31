<?php

declare(strict_types=1);

namespace HotsaleApi\Modules\User;

final class SignUpDto
{
    private ?string $userName;
    private ?string $userSurname;
    private ?string $userEmail;
    private ?string $userPassword;
    private ?string $userConfirmPassword;

    private function __construct(
        ?string $userName,
        ?string $userSurname,
        ?string $userEmail,
        ?string $userPassword,
        ?string $userConfirmPassword
    ) {
        $this->userName            = $userName;
        $this->userSurname         = $userSurname;
        $this->userEmail           = $userEmail;
        $this->userPassword        = $userPassword;
        $this->userConfirmPassword = $userConfirmPassword;
    }

    public static function fromArray(array $input): self
    {
        return new self(
            $input['userName'] ?? null,
            $input['userSurname'] ?? null,
            $input['userEmail'] ?? null,
            $input['userPassword'] ?? null,
            $input['userConfirmPassword'] ?? null,
        );
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getUserSurname(): string
    {
        return $this->userSurname;
    }

    public function getUserEmail(): string
    {
        return $this->userEmail;
    }

    public function getUserPassword(): string
    {
        return $this->userPassword;
    }

    public function getUserConfirmPassword(): string
    {
        return $this->userConfirmPassword;
    }
}