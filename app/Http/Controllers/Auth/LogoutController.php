<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    // public function getRedirectPath(): string
    // {
    //     $user = auth()->user();

    //     if ($user->isWebGroup()) {
    //         return route('login.form');
    //     }

    //     return route('admin.login.form');
    // }

    public function logout(Request $request)
    {
        // $redirectPath = $this->getRedirectPath();

        // auth()->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        // return redirect($redirectPath);
        return logout();
    }
}
