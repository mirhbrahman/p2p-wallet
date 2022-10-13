<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
           return response()->error('Not found', [], $e->getStatusCode());
        });

        $this->renderable(function (ValidationException $e, $request) {
            $errors = $e->validator->errors()->getMessages();
            return response()->error($e->getMessage(), $errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        });

        $this->renderable(function (AuthenticationException $e, $request) {
            return response()->error($e->getMessage(), [], Response::HTTP_UNAUTHORIZED);
        });


        // .............will handle more exception
        $this->renderable(function (Exception $e, $request) {
            $fe = FlattenException::create($e);
            return response()->error($fe->getMessage(), [], $fe->getStatusCode());
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
