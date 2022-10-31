<?php

declare(strict_types=1);

namespace HotsaleApi\Middleware;

use Fig\Http\Message\StatusCodeInterface;
use HotsaleApi\Service\JsonFormatInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

/**
 * To use this class as a middleware, you can use ->add( new ExampleMiddleware() ); function chain after the $app,
 * Route, or group()
 */
final class ValidationExceptionMiddlaware
{
    private JsonFormatInterface $jsonFormat;

    public function __construct(JsonFormatInterface $jsonFormat)
    {
        $this->jsonFormat = $jsonFormat;
    }

    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface
    {
        try {
            $response = $handler->handle($request);
        } catch (\HotsaleApi\Exception\ValidationException $validationException) {
            $jsonMsg  = implode("\n", $validationException->getValidationExceptions());
            $code     = StatusCodeInterface::STATUS_UNPROCESSABLE_ENTITY;
            $json     = $this->jsonFormat->error($request->getParsedBody(), $jsonMsg, $code);
            $response = new Response($code);
            $response->getBody()->write($json);
        }

        return $response;
    }
}