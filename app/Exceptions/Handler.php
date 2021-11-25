<?php

namespace App\Exceptions;

use App\Library\ConstantLibrary;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
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
            $aResponse = [
                'status_code' => ConstantLibrary::STATUS_CODE_404,
                'message'     => ConstantLibrary::STATUS_CODE_404_MESSAGE
            ];
            return response()->json($aResponse, ConstantLibrary::STATUS_CODE_404);
        });
    }
}
