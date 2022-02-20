<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function redirectAfterLogin()
    {
        $user = auth()->user();

        alert()->success('Login success');

    	if ($user->role === null || $user->hasRole('customer')) {
    		return redirect()->route('customer.home');
    	}

    	return redirect()->route('home');
    }

    public function redirectIfFail()
    {
        alert()->error('Login failed');
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
