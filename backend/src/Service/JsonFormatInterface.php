<?php

declare(strict_types=1);

namespace HotsaleApi\Service;

interface JsonFormatInterface
{
    public function success(?array $data = null): string;

    public function error(
        array  $data,
        string $errorMessage,
        int $errorCode
    ): string;
}