<?php

declare(strict_types=1);

namespace Modules\Service;

use JSend\InvalidJSendException;
use JSend\JSendResponse;

final class JsendFormatter implements JsonFormatInterface
{
    /**
     * @throws InvalidJSendException
     */
    private static function jsonMessage(
        string  $status,
        array   $data = null,
        ?string $errorMessage = null,
        ?string $errorCode = null
    ): string {
        return (new JSendResponse($status, $data, $errorMessage, $errorCode))->encode();
    }

    public function success(?array $data = null): string
    {
        return self::jsonMessage(JSendResponse::SUCCESS, $data);
    }

    public function withError(
        array  $data,
        string $errorMessage,
        int $errorCode
    ): string {
        return self::jsonMessage(JSendResponse::ERROR, $data, $errorMessage, (string) $errorCode);
    }
}