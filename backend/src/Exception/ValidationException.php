<?php

declare(strict_types=1);

namespace HotsaleApi\Exception;

final class ValidationException extends \Exception
{
    private array $validationExceptions;

    private function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param string[] $validationExceptions
     * Some unique logic for validating
     * for example it can be initialized with typed collection of errors, and return to middlaware them
     *
     * @return static
     */
    public static function create(array $validationExceptions): self
    {
        $item                       = new self('Validation error');
        $item->validationExceptions = $validationExceptions;

        return $item;
    }

    /**
     * @return array|string[]
     */
    public function getValidationExceptions(): array
    {
        return $this->validationExceptions;
    }
}