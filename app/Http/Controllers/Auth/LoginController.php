<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showFormLogin()
    {
        return view('pages.auth.login', ['url' => $this->getUrlLogin()]);
    }

    public function getUrlLogin()
    {
        return request()->is('admin*')
            ? route('admin.login.process')
            : route('login.process');
    }

    public function redirectAfterLogin()
    {
        $user = auth()->user();

        alert()->success(
            __('action success', ['Action' => 'Đăng nhập'])
        );

        if ($user->isWebGroup()) {
            return redirect()->route('home');
        }

        return redirect()->route('admin.home');
    }

    public function redirectIfFail()
    {
        alert()->error(
            __('action fail', ['Action' => 'Đăng nhập'])
        );
        
        return redirect()->back()->withInput();
    }

    public function login(LoginFormRequest $request)
    {
        $credentials = $request->validated();
        $remember    = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return $this->redirectAfterLogin();
        }

        return $this->redirectIfFail();
    }
}
