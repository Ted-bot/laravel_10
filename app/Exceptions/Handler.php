<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;


class Handler extends ExceptionHandler
{

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
        //
        });
    }

    protected function buildContext(Throwable $e): array
        {
            return [
                'exception' => [
                    'origin' => $e,
                    'context' => [
                        'common' => $this->context(),
                        'specific' => $this->exceptionContext($e),
                    ],
                ],
            ];
        }
}
