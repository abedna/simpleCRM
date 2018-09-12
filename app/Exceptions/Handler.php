<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\HttpKernel\Exception\HttpException;


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
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
          
          if ($exception instanceof FatalErrorException  && config('app.debug')==true) {
              $exception = new HttpException(500, "Server error");
          }

          if ($exception instanceof ModelNotFoundException  && config('app.debug')==true) {
          $exception = new HttpException(500, "Model not found");
          }

          if ($exception instanceof RelationNotFoundException  && config('app.debug')==true) {
          $exception = new HttpException(500, "Relation not found");
          }

          if (config('app.debug')==true && $exception->getStatusCode()==403)  {
          $exception = new HttpException(403, "Not allowed");
          //dd($exception->getMessage());
          //return response()->view('errors.403');
          }

        return parent::render($request, $exception);
    }
}


