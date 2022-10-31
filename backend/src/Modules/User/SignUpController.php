<?php

declare(strict_types=1);

namespace HotsaleApi\Modules\User;

use HotsaleApi\Modules\AbstractController;
use HotsaleApi\Service\JsonFormatInterface;
use Monolog\Handler\StreamHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class SignUpController extends AbstractController
{
    private UserRepositoryInterface $userRepository;
    private JsonFormatInterface     $jsonFormat;
    private LoggerInterface         $logger;
    private string                  $rootDir;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param JsonFormatInterface     $jsonFormat
     * @param LoggerInterface         $logger
     * @param string                  $rootDir
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        JsonFormatInterface     $jsonFormat,
        LoggerInterface         $logger,
        string                  $rootDir
    ) {
        $this->userRepository = $userRepository;
        $this->jsonFormat     = $jsonFormat;
        $this->logger         = $logger;
        $this->rootDir        = $rootDir;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $record = SignUpDto::fromArray($request->getParsedBody());
        /**
         * at his point I've would recomend to do anotation validation
         * of this dto with symfony validation or similar package, but seems like it will be too match for current task
         */
        SignUpDtoValidator::validate($record);
        $this->logger->pushHandler(
            new StreamHandler($this->rootDir . '/data/userReg.log', LogLevel::INFO)
        );
        $this->log($this->userRepository->exists($record->getUserEmail()), $record);

        return $this->formatedResponse($response, $this->jsonFormat->success());
    }

    private function log(bool $exists, SignUpDto $dto): void
    {
        if ($exists) {
            $this->logger->info(sprintf("User `%s` exists in db", $dto->getUserEmail()));
            return;
        }
        $this->logger->warning(sprintf("User `%s` does not exists in db", $dto->getUserEmail()));
    }

}