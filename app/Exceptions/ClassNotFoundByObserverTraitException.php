<?php

namespace App\Exceptions;

use Exception;

class ClassNotFoundByObserverTraitException extends Exception
{
    private string $pathError;
    private string $observerFileName;

    public function __construct(string $observerFileName, string $pathError)
    {
        parent::__construct();

        $this->observerFileName = $observerFileName;
        $this->pathError = $pathError;
    }

    public function context(): array
    {
        return [
            'path_error' => $this->pathError,
            'not_found' => $this->observerFileName
        ];
    }

}
