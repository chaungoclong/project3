<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Services\Auth\AuthService;

class RegisterController extends Controller
{
    public function register(RegisterFormRequest $request,
        AuthService $authService) {
        try {
            $authService->register($request->validated());
            return $this->redirectAfterRegister('register success');
        } catch (\Exception $e) {
            return $this->redirectIfFail($e->getMessage());
        }
    }

    public function redirectAfterRegister($message)
    {
        alert()->success($message);
        return redirect()->route('login.web.form');
    }

    public function redirectIfFail($message)
    {
        alert()->error($message);
        return redirect()->back()->withInput();
    }
}
