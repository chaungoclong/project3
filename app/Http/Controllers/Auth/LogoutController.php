<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function getRedirectPath()
    {
        $user = auth()->user();

        if ($user->role === null || $user->hasRole('customer')) {
            return route('login.web.form');
        }

        return route('login.admin.form');
    }

    public function logout(Request $request)
    {
        $redirectPath = $this->getRedirectPath();

        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect($redirectPath);
    }
}
