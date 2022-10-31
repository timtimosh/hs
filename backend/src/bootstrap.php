<?php

declare(strict_types=1);

namespace HotsaleApi;

use HotsaleApi\Middleware\ExceptionMiddlaware;
use HotsaleApi\Middleware\ValidationExceptionMiddlaware;
use HotsaleApi\Modules\User;
use HotsaleApi\Service\JsendFormatter;
use HotsaleApi\Service\JsonFormatInterface;
use League\Container\Container;
use League\Container\ReflectionContainer;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

function createApp(): App
{
    /** config */
    $container = new Container();
    $app       = AppFactory::create(null, $container);
    $app->addBodyParsingMiddleware();
    dependencyInjection($container);
    /** endconfig */
    /** middlawares */
    $app->add(new ValidationExceptionMiddlaware(new JsendFormatter()));
    $app->add(new ExceptionMiddlaware(new JsendFormatter()));
    /** middlawares end*/
    /** routes */
    routes($app);
    /** endroutes */

    return $app;
}

function dependencyInjection(Container $container): void
{
    // register the reflection container as a delegate to enable auto wiring
    $container->delegate(
        new ReflectionContainer()
    );
    $container->add(LoggerInterface::class, Logger::class)->addArgument('hotsale');
    $container->add(JsonFormatInterface::class, JsendFormatter::class);
    $container->add(
        'inMemoryUsers', [
                           ['id' => 1, 'email' => 'test1@gmail.com', 'name' => 'u1'],
                           ['id' => 2, 'email' => 'test2@gmail.com', 'name' => 'u2'],
                           ['id' => 3, 'email' => 'test3@gmail.com', 'name' => 'u3'],
                       ]
    );
    $container->add(User\UserRepositoryInterface::class, User\UserRepository::class)->addArgument(
        $container->get('inMemoryUsers')
    );
    $container->add('rootDir', dirname(__DIR__));
}

function routes(App $app): void
{
    $container = $app->getContainer();
    $app->post('/user', function ($request, $response, array $args) use ($container) {
        return (new User\SignUpController(
            $container->get(User\UserRepositoryInterface::class),
            $container->get(JsonFormatInterface::class),
            $container->get(LoggerInterface::class),
            $container->get('rootDir')
        ))(
            $request,
            $response
        );
    });
    $app->get('/user', User\ListController::class);
}
