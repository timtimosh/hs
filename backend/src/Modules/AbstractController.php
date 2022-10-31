<?php

declare(strict_types=1);

namespace HotsaleApi\Modules;

use Fig\Http\Message\StatusCodeInterface;
use Modules\Service\JsonFormatInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

class AbstractController
{
    protected function formatedResponse(
        ResponseInterface $response,
        string            $body,
        ?int              $code = StatusCodeInterface::STATUS_OK
    ): ResponseInterface {
        $response = $response->withStatus($code);
        $response->getBody()->write($body);

        return $response;
    }
}