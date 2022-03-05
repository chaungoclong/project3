<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Services\Auth\AuthService;

class RegisterController extends Controller
{
    public function showFormRegister()
    {
        return view('pages.auth.register');
    }

    public function register(
        RegisterFormRequest $request,
        AuthService $authService
    ) {
        try {
            $authService->register($request->validated());

            return $this->redirectAfterRegister(
                __('action success', ['Action' => 'Đăng ký'])
            );
        } catch (\Exception $e) {
            // dd($e);
            return $this->redirectIfFail(
                __('action fail', ['Action' => 'Đăng ký'])
            );
        }
    }

    public function redirectAfterRegister($message)
    {
        alert()->success($message);

        return redirect()->route('login.form');
    }

    public function redirectIfFail($message)
    {
        alert()->error($message);

        return redirect()->back()->withInput();
    }
}
