<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\PageController;
use App\Models\Role;
use App\Models\User;
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
// Route::get('/admin', [HomeController::class, 'index'])
//     ->name('home')
//     ->middleware(['auth']);

// Route::get('', function() {
//     echo "customer";
// })->name('customer.home')->middleware('auth');

// Route::get('/test', function (Request $request) {
//     // $request->validate(['ids' => ['required']]);
// //    dd(
// //     Role::first()->givePermissionTo(1, 2, 3, 4),
// //     Role::first()->permissions,
// //     Role::first()->syncPermission(['create-role', 'view-role']),
// //     Role::first()->permissions,
// //     Permission::all(),
// // );
//    // return redirect()->route('home')->withSuccess('ok');
//     // return redirect()->route('home')->with('success','ok');
//     // Permission::create(['title' => "edit", 'name' => 'edit']);
//     // Role::first()->permissions()->detach();
//     // Role::first()->permissions()->sync([
//     //     1, 2, 3
//     // ]);
//     // $a = null;
//     // dd(optional($a)->name);
//     // return view('test');
//     // dd( Role::first()->syncPermission(1, 'delete', Permission::find(3)));
//     // dd(Role::first()->getPermissionExitsInKeys(1, 'edit'));
//     // dd(User::first()->hasAnyPermission('edit', Permission::find(3)));
//     // dd(Permission::where('name', 'edit3')->update(['name' => 'edit4', 'title' => 'edit4', 'group' => 'product']));
//     // dd(Permission::first()->delete());
//     // $namespace = "Abc\\Xyz";

//     // $bind = '/User';
//     // $bind = trim($bind, '\/ ');
//     // $segments = explode('/', $bind);
//     // // dd($segments);

//     // $model = array_pop($segments);
//     // $className = '';
//     // if (count($segments) > 0) {
//     //     $className = $namespace . '\\' . implode('\/', $segments) . '\\' . $model . 'Service';
//     // } else {
//     //     $className = $namespace . '\\' . $model . 'Service';
//     // }
//     dd(Role::first()->permissions()->toSql());
//     // dd($className);
//     return view('welcome');
// })->name('test')->middleware('hasPermission:view-role');

// // LOGIN
// Route::group(['as' => 'login.', 'middleware' => ['guest']], function () {
//     Route::view('/admin/login', 'pages.auth.login')->name('admin.form');

//     Route::view('/login', 'pages.auth.login')->name('web.form');

//     Route::post('/login-process', [LoginController::class, 'login'])
//         ->name('process');
// });

// // REGISTER
// Route::group(['as' => 'register.', 'middleware' => ['guest']], function () {
//     Route::view('/register', 'pages.auth.register')->name('form');

//     Route::post('/register-process', [RegisterController::class, 'register'])
//         ->name('process');
// });

// // LOGOUT
// Route::get('/logout', [LogoutController::class, 'logout'])->name('logout')
//     ->middleware('auth');

// // ADMIN
// Route::group([
//     'prefix'     => 'admin',
//     'middleware' => ['auth'],
//     'as'         => 'admin.',
// ], function () {
//     // ROLE
//     Route::group([
//         'prefix' => 'roles',
//         'as' => 'roles.'
//     ], function () {
//         // get datatables
//         Route::get('get-datatables', [RoleController::class, 'getDatatables'])
//             ->name('get_datatables')->middleware('hasPermission:view-role');
//         Route::delete('delete-multiple', [RoleController::class, 'deleteMultiple'])->name('delete_multiple');
//         Route::patch('set-default/{role}',
//             [RoleController::class, 'setRoleDefault']
//         )->name('set_default');
//     });
//     Route::resource('roles', RoleController::class)
//         ->middleware(['hasPermission:view-role,edit-role,create-role']);

//     // USER

// });
Route::get('test', function () {
    dd(arrayInArray([5], [1, 2, 3]));
});

Route::middleware(['auth'])->group(
    function () {
        // ---------- Web Home ----------
        Route::get('', [PageController::class, 'dashboard'])
            ->name('home');
        // ---------- /Web Home ----------

        // ---------- Customer Logout ----------
        Route::get('/logout', [LogoutController::class, 'logout'])
            ->name('logout');
        // ---------- /Customer Logout ----------
    }
);

Route::middleware(['guest'])->group(
    function () {
        // ---------- Customer Login ----------
        Route::controller(LoginController::class)->group(
            function () {
                Route::get('/login', 'showFormLogin')->name('login.form');
                Route::post('/login', 'login')->name('login.process');
            }
        );
        // ---------- /Customer Login ----------

        // ---------- Customer Register ----------
        Route::controller(RegisterController::class)->group(
            function () {
                Route::get('/register', 'showFormRegister')
                    ->name('register.form');
                Route::post('/register', 'register')
                    ->name('register.process');
            }
        );
        // ---------- /Customer Register ----------
    }
);
