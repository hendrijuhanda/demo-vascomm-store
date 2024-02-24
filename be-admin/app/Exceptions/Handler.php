<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($request->segment(1) === 'api' || $request->expectsJson()) {
            $data = null;
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;

            if ($e instanceof ValidationException) {
                $data = $e->errors();
                $status = $e->status;
            }

            if ($e instanceof HttpException) {
                $status = $e->getStatusCode();
            }

            if ($e instanceof ModelNotFoundException) {
                $status = Response::HTTP_NOT_FOUND;
            }

            if ($e instanceof UnauthorizedException) {
                $status = Response::HTTP_UNAUTHORIZED;
            }

            $format = [
                'code' => $status,
                'message' => $e->getMessage(),
                'data' => $data
            ];

            return response()->json($format, $status);
        }

        return parent::render($request, $e);
    }
}
