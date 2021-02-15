<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        return $this->handleApiException($request, $exception);
    }

    private function handleApiException($request, Exception $exception)
    {
        $statusCode = null;
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return response()->json([
                'errors' => $exception->errors()
            ], 422);
        } else if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException || $statusCode == 404) {
            return response()->json([
                'message' => 'Not Found'
            ], 404);
        } else if ($statusCode == 405) {
            return response()->json([
                'message' => 'Method not allowed'
            ], 405);
        } else {
            return response()->json([
                'message' => 'Whoops, looks like something went wrong!'
            ], $statusCode ?? 500);
        }
    }
}
