<?php

declare(strict_types=1);

namespace HotsaleApi\Modules\User;

use Fig\Http\Message\StatusCodeInterface;
use Modules\Service\JsonFormatInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

class AbstractController
{
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    protected function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    protected function formatedResponse(
        ResponseInterface $response,
        string            $body,
        ?int              $code = StatusCodeInterface::STATUS_OK
    ): ResponseInterface {
        $response = $response->withStatus($code);
        $response->getBody()->write($body);

        return $response;
    }

    protected function getFormatter(): JsonFormatInterface
    {
        return $this->getContainer()->get(JsonFormatInterface::class);
    }
}