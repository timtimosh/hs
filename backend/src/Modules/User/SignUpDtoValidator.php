<?php

declare(strict_types=1);

namespace HotsaleApi\Modules\User;

use HotsaleApi\Exception\ValidationException;

final class SignUpDtoValidator
{
    public static function validate(SignUpDto $input): void
    {
        $email  = $input->getUserEmail();
        $errors = [];
        if (!trim($email)
            || !strpos($email, '@')) {
            $errors[] = 'Email must contain @ symbol';
        }
        if ($input->getUserConfirmPassword() !== $input->getUserPassword()) {
            $errors[] = 'Passwords are not match';
        }
        if(trim($email) === 'test@gmail.com'){
            $errors[] = 'Email `test@gmail.com` can`t be used for signUp!';
        }

        if (count($errors)) {
            throw ValidationException::create($errors);
        }
    }
}