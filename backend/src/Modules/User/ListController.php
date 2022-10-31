<?php

declare(strict_types=1);

namespace HotsaleApi\Modules\User;

use HotsaleApi\Modules\AbstractController;
use HotsaleApi\Service\JsonFormatInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ListController extends AbstractController
{
    private UserRepositoryInterface $userRepository;
    private JsonFormatInterface     $jsonFormat;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param JsonFormatInterface     $jsonFormat
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        JsonFormatInterface     $jsonFormat
    ) {
        $this->userRepository = $userRepository;
        $this->jsonFormat     = $jsonFormat;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $users = $this->userRepository->fetch();

        return $this->formatedResponse($response, $this->jsonFormat->success($users));
    }
}
