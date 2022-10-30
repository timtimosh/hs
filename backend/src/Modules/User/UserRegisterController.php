<?php

declare(strict_types=1);

namespace HotsaleApi\Modules\User;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UserRegisterController extends AbstractController
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $input = $request->getParsedBody();
        $ok    = true;
        $result = null;
        if ($ok) {
        }

        return $this->formatedResponse(
            $response,
            $this->getFormatter()->success()
        );
    }
}