<?php

namespace App\Exceptions;

use Exception;

class ClassNotFoundByObserverTraitException extends Exception
{
    protected string $customeMessage;
    protected int $customeCode;

    public function __construct(string $customMessage, string $customeCode)
    {
        parent::__construct($customMessage, $customeCode);
    }
}
