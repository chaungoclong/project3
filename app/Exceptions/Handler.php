<?php

namespace App\Exceptions;

use App\Exceptions\NoPermissionException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
        $this->renderable(function(NoPermissionException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage()
                ], 403);
            }
            return abort(403, $e->getMessage());
        });
    }

    protected function prepareException(\Throwable $e)
    {
        if ($e instanceof TokenMismatchException) {
            $e = new HttpException(419, 'Bạn chưa đăng nhập hoặc phiên đăng nhập đã hết hạn', $e);
        }

        return parent::prepareException($e);
    }

    protected function unauthenticated($request, 
        AuthenticationException $exception) 
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Bạn chưa đăng nhập hoặc phiên đăng nhập đã hết hạn.'
            ], 401);
        }

        if ($request->is('admin*')) {
            return redirect()->route('login.admin.form');
        }

        return redirect()->route('login.web.form');
    }
}
