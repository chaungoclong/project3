<?php

use App\Exceptions\NoPermissionException;

/**
 * lay duong dan chuyen huong den sau khi dang xuat
 */
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

/**
 * dang xuat
 */
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

/**
 * kiem tra nguoi dung hien tai co quyen nao do
 * neu nguoi dung khong co quyen can kiem tra thi nem ra ngoai le
 * NoPermissionException (duoc xu ly trong file handle.php)
 */
if (!function_exists('checkPermission')) {
    function checkPermission($permission)
    {
        if (!Gate::allows($permission)) {
            throw new NoPermissionException(
                __('unauthorized to do', ['action' => 'truy cập'])
            );
        }
    }
}

// ---------- Array Helper ----------

/**
 * Loai bo khoang trang cua cac phan tu trong mang cac chuoi
 */
if (!function_exists('trimStringArray')) {
    function trimStringArray($array = []): array
    {
        return array_map(fn($value) => trim($value), $array);
    }
}

if (!function_exists('arrayInArray')) {
    function arrayInArray($array, $arrays): bool
    {
        return array_diff($array, $arrays) === [];
    }
}
// ---------- /Array Helper ----------
