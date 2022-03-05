<?php

use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\Role\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::middleware(
    ['auth', 'userActive', 'exceptRole:customer']
)->group(function () {
    // ---------- Admin Home ----------
    Route::get('', [PageController::class, 'dashboard'])
        ->name('home');
    // ---------- /Admin Home ----------

    // ---------- Admin Logout ----------
    Route::get('/logout', [LogoutController::class, 'logout'])
        ->name('logout');
    // ---------- /Admin Logout ----------

    // ---------- Role Manager ----------
    Route::group([
        'prefix' => 'roles',
        'as'     => 'roles.',
    ], function () {
        // load datatables
        Route::get(
            'get-datatables',
            [RoleController::class, 'getDatatables']
        )->name('get_datatables')
            ->middleware('hasPermission:view-role');

        // delete multiple role
        Route::delete(
            'delete-multiple',
            [RoleController::class, 'deleteMultiple']
        )->name('delete_multiple')
            ->middleware('hasPermission:delete-role');

        // set role default
        Route::patch(
            'set-default/{role}',
            [RoleController::class, 'setRoleDefault']
        )->name('set_default');
    });

    Route::resource('roles', RoleController::class);
    // ---------- /Role Manager ----------
});

Route::middleware(['guest'])->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showFormLogin')->name('login.form');
        Route::post('/login', 'login')->name('login.process');
    });
});
