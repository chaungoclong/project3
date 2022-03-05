<?php

if (!function_exists('getRedirectPathAfterLogout')) {
    function getRedirectPathAfterLogout()
    {
        $user = auth()->user();

        if ($user->isWebGroup()) {
            return route('login.form');
        }

        return route('admin.login.form');
    }
}

if (!function_exists('logout')) {
    function logout()
    {
        $redirectPath = getRedirectPathAfterLogout();

        auth()->logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect($redirectPath);
    }
}
