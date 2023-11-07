<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/AboutUs', function () {
    return view('AboutUs');
});

Route::middleware(['auth', 'global.admin'])->group(function () {
    Route::get('/AdminAccess', [App\Http\Controllers\GlobalAdminController::class, 'listUsers'])->name('allUsers');
    Route::post('/AdminAccess/{user}/grant-admin-access', [App\Http\Controllers\GlobalAdminController::class, 'grantAdminAccess'])->name('grantAdminAccess');
    Route::post('/AdminAccess/{user}/revoke-admin-access', [App\Http\Controllers\GlobalAdminController::class, 'revokeAdminAccess'])->name('revokeAdminAccess');
});

//The code for password reset is from laravel documentation: https://laravel.com/docs/10.x/passwords
    
Route::get('/forgot-password', function () {
    return view('auth.passwords.email');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.passwords.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');


//to register gym
Route::get('registerGym/getStarted', function () {
    return view('registerGym.getStarted');
});

//Route::get('registerGym/addGym', function(){
  //  return view('registerGym.addGym');
//})->name('gyms.create');

Route::get('/gyms/create', 'App\Http\Controllers\GymController@createGym')->name('gyms.create'); //only admins have access to this
Route::post('storeGym',  'App\Http\Controllers\GymController@storeGym');
Route::get('/membership/create', 'App\Http\Controllers\MembershipController@createMembership')->name('membership.create'); //only admins have access to this
Route::post('StoreMembership', 'App\Http\Controllers\MembershipController@storeMembership')->name('memberships.store');

Route::get('gymIndividual/{Gym_id}', 'App\Http\Controllers\GymController@show')->name('gymIndividual');

Route::get('gymAll','App\Http\Controllers\GymController@list')->name('list_gym');