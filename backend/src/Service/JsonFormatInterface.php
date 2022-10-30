<?php

declare(strict_types=1);

namespace Modules\Service;

interface JsonFormatInterface
{
    public function success(?array $data = null): string;

    public function withError(
        array  $data,
        string $errorMessage,
        int $errorCode
    ): string;
}