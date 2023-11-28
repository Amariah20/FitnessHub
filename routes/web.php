<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\GlobalAdminController;
use App\Http\Middleware\AdminAccess;
 

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
})->name('aboutus');

//I used this for help to write routes that only admin/global admin can access: https://www.youtube.com/watch?v=-a7JvwW60xk
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

//to display gyms
Route::get('gymIndividual/{Gym_id}', 'App\Http\Controllers\GymController@show')->name('gymIndividual');

Route::get('gymAll','App\Http\Controllers\GymController@list')->name('list_gym');

Route::get('classesOfferings/{Gym_id}', 'App\Http\Controllers\GymController@showOfferings')->name('classesOfferings');

Route::get('classShow, {Class_id}', 'App\Http\Controllers\ClassesController@show')->name('classShow');
Route::get('offeringShow, {Offering_id}', 'App\Http\Controllers\OfferingController@show')->name('offeringShow');

//to register gyms
Route::get('registerGym/getStarted', function () {
    return view('registerGym.getStarted');
})->middleware('admin');

//Route::get('registerGym/addGym', function(){
  //  return view('registerGym.addGym');
//})->name('gyms.create');



Route::get('/gyms/create', 'App\Http\Controllers\GymController@createGym')->middleware('admin')->name('gyms.create'); //only admins have access to this
Route::post('storeGym',  'App\Http\Controllers\GymController@storeGym');

Route::get('/membership/create', 'App\Http\Controllers\MembershipController@createMembership')->middleware('admin')->name('membership.create'); //only admins have access to this
Route::post('StoreMembership', 'App\Http\Controllers\MembershipController@storeMembership')->name('memberships.store');


Route::get('/class/create', 'App\Http\Controllers\ClassesController@createClass')->middleware('admin')->name('class.create'); //only admins have access to this
Route::post('StoreClass', 'App\Http\Controllers\ClassesController@storeClass')->name('class.store');

Route::get('/offering/create', 'App\Http\Controllers\OfferingController@createOffering')->middleware('admin')->name('offering.create'); //only admins have access to this
Route::post('StoreOffering', 'App\Http\Controllers\OfferingController@storeOffering')->name('offering.store');


Route::get('/equipment/create', 'App\Http\Controllers\EquipmentController@createEquipment')->middleware('admin')->name('equipment.create'); //only admins have access to this
Route::post('StoreEquipment', 'App\Http\Controllers\EquipmentController@storeEquipment')->name('equipment.store');

//Route::get('/image/create', 'App\Http\Controllers\ImageController@createImage')->middleware('admin')->name('image.create'); //only admins have access to this
//Route::post('StoreImage', 'App\Http\Controllers\ImageController@storeImage')->name('image.store');

Route::get('successGym', 'App\Http\Controllers\SuccessController@message' )->name('sucessGym');
Route::get('success','App\Http\Controllers\SuccessController@display' )->name('display');



//Admin Interface
Route::get('AdminWelcome',  'App\Http\Controllers\AdminPanelController@AdminWelcome' )->name('AdminWelcome');
Route::get('AdminFirst', 'App\Http\Controllers\AdminPanelController@AdminFirst')->name('AdminFirst');
Route::get('AdminClass/{Gym_id}', 'App\Http\Controllers\AdminPanelController@AdminClass')->name('AdminClass');
Route::get('AdminOffering/{Gym_id}', 'App\Http\Controllers\AdminPanelController@AdminOffering')->name('AdminOffering');
Route::get('AdminMembership/{Gym_id}', 'App\Http\Controllers\AdminPanelController@AdminMembership')->name('AdminMembership');
Route::get('AdminEquipment/{Gym_id}', 'App\Http\Controllers\AdminPanelController@AdminEquipment')->name('AdminEquipment');
Route::get('EditGym/{Gym_id}','App\Http\Controllers\AdminPanelController@EditGym')->name('EditGym');
Route::patch('UpdateGym/{Gym_id}','App\Http\Controllers\AdminPanelController@UpdateGym')->name('UpdateGym');
Route::get('EditClass/{Class_id}','App\Http\Controllers\AdminPanelController@EditClass')->name('EditClass');
Route::patch('UpdateClass/{Class_id}','App\Http\Controllers\AdminPanelController@UpdateClass')->name('UpdateClass');
Route::get('EditMembership/{Membership_id}','App\Http\Controllers\AdminPanelController@EditMembership')->name('EditMembership');
Route::patch('UpdateMembership/{Membership_id}','App\Http\Controllers\AdminPanelController@UpdateMembership')->name('UpdateMembership');
Route::get('EditEquipment/{Equipment_id}','App\Http\Controllers\AdminPanelController@EditEquipment')->name('EditEquipment');
Route::patch('UpdateEquipment/{Equipment_id}','App\Http\Controllers\AdminPanelController@UpdateEquipment')->name('UpdateEquipment');
Route::get('EditOffering/{Offering_id}','App\Http\Controllers\AdminPanelController@EditOffering')->name('EditOffering');
Route::patch('UpdateOffering/{Offering_id}','App\Http\Controllers\AdminPanelController@UpdateOffering')->name('UpdateOffering');
Route::get('AdminAddClass/{Gym_id}','App\Http\Controllers\AdminPanelController@AdminCreateClass')->name('AdminAddClass');
Route::post('AdminClassStore/{Gym_id}', 'App\Http\Controllers\AdminPanelController@AdminClassStore')->name('AdminClassStore');
Route::get('AdminAddMembership/{Gym_id}','App\Http\Controllers\AdminPanelController@AdminCreateMembership')->name('AdminAddMembership');
Route::post('AdminMembershipStore/{Gym_id}', 'App\Http\Controllers\AdminPanelController@AdminMembershipStore')->name('AdminMembershipStore');
Route::get('AdminAddOffering/{Gym_id}','App\Http\Controllers\AdminPanelController@AdminCreateOffering')->name('AdminAddOffering');
Route::post('AdminOfferingStore/{Gym_id}', 'App\Http\Controllers\AdminPanelController@AdminOfferingStore')->name('AdminOfferingStore');
Route::get('AdminAddEquipment/{Gym_id}','App\Http\Controllers\AdminPanelController@AdminCreateEquipment')->name('AdminAddEquipment');
Route::post('AdminEquipmentStore/{Gym_id}', 'App\Http\Controllers\AdminPanelController@AdminEquipmentStore')->name('AdminEquipmentStore');
Route::get('DeleteClass/{Class_id}', 'App\Http\Controllers\AdminPanelController@DeleteClass')->name('DeleteClass');
Route::get('DeleteMembership/{Membership_id}', 'App\Http\Controllers\AdminPanelController@DeleteMembership')->name('DeleteMembership');
Route::get('DeleteOffering/{Offering_id}', 'App\Http\Controllers\AdminPanelController@DeleteOffering')->name('DeleteOffering');
Route::get('DeleteEquipment/{Equipment_id}', 'App\Http\Controllers\AdminPanelController@DeleteEquipment')->name('DeleteEquipment');
