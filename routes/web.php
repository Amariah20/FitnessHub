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

/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'App\Http\Controllers\GymController@list')->name('welcome');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/AboutUs', function () {
    return view('AboutUs');
})->name('AboutUs');

//I used this for help to write routes that only admin/global admin can access: https://www.youtube.com/watch?v=-a7JvwW60xk
Route::middleware(['auth', 'global.admin'])->group(function () {
    Route::get('/AdminAccess', 'App\Http\Controllers\GlobalAdminController@listUsers')->name('AdminAccess');
    Route::post('/AdminAccess/{user}/grant-admin-access', 'App\Http\Controllers\GlobalAdminController@grantAdminAccess')->name('grantAdminAccess');
    Route::post('/AdminAccess/{user}/revoke-admin-access', 'App\Http\Controllers\GlobalAdminController@revokeAdminAccess')->name('revokeAdminAccess');
    Route::get('/globalAdminGyms', 'App\Http\Controllers\GlobalAdminController@globalAdminGyms')->name('globalAdminGyms');
    Route::get('/reviewStatus/{Gym_id}', 'App\Http\Controllers\RatingController@reviewStatus')->name('reviewStatus');
    Route::post('approveStatus', 'App\Http\Controllers\RatingController@approveStatus')->name('approveStatus');
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
//Route::get('gymIndividual/{slug}', 'App\Http\Controllers\GymController@show')->name('gymIndividual');
Route::get('gymIndividual/{Gym_id}', 'App\Http\Controllers\GymController@show')->name('gymIndividual');

//Route::get('gymIndividual/{gym}', 'App\Http\Controllers\GymController@show')->name('gymIndividual');
Route::get('gymAll','App\Http\Controllers\GymController@list')->name('gymAll');
//Route::get('gymAll/{filter?}','App\Http\Controllers\GymController@list')->name('gymAll'); //? means that filter is optional.
Route::get('sortMembershipPrice','App\Http\Controllers\FilterSortController@sortMembershipPrice')->name('sortMembershipPrice');
Route::get('filterLocation','App\Http\Controllers\FilterSortController@filterLocation')->name('filterLocation');
Route::post('storeRating', 'App\Http\Controllers\RatingController@storeRating')->name('storeRating');

Route::get('classesOfferings/{Gym_id}', 'App\Http\Controllers\GymController@showOfferings')->name('classesOfferings');

Route::get('classShow, {Class_id}', 'App\Http\Controllers\ClassesController@show')->name('classShow');
Route::get('offeringShow, {Offering_id}', 'App\Http\Controllers\OfferingController@show')->name('offeringShow');

Route::get('showEquipments/{Gym_id}', 'App\Http\Controllers\GymController@showEquipments')->name('showEquipments');
//Route::get('equipments, {Gym_id}', 'App\Http\Controllers\EquipmentController@show')->name('equipments');

//to register gyms
Route::get('registerGym/getStarted', function () {
    return view('registerGym.getStarted');
})->middleware('admin')->name('registerGym/getStarted');

//Route::get('registerGym/addGym', function(){
  //  return view('registerGym.addGym');
//})->name('gyms.create');



Route::get('/gyms/create', 'App\Http\Controllers\GymController@createGym')->middleware('admin')->name('gyms.create'); //only admins have access to this
Route::post('storeGym',  'App\Http\Controllers\GymController@storeGym')->middleware('admin')->name('gym.store');

Route::get('/membership/create', 'App\Http\Controllers\MembershipController@membershipCreate')->middleware('admin')->name('memberships.create'); //only admins have access to this
Route::post('StoreMembership', 'App\Http\Controllers\MembershipController@membershipStore')->middleware('admin')->name('membership.store');


Route::get('/class/create', 'App\Http\Controllers\ClassesController@createClass')->middleware('admin')->name('class.create'); //only admins have access to this
Route::post('StoreClass', 'App\Http\Controllers\ClassesController@storeClass')->middleware('admin')->name('class.store');


Route::get('/offering/create', 'App\Http\Controllers\OfferingController@createOffering')->middleware('admin')->name('offering.create'); //only admins have access to this
Route::post('StoreOffering', 'App\Http\Controllers\OfferingController@storeOffering')->middleware('admin')->name('offering.store');


Route::get('/equipment/create', 'App\Http\Controllers\EquipmentController@createEquipment')->middleware('admin')->name('equipment.create'); //only admins have access to this
Route::post('StoreEquipment', 'App\Http\Controllers\EquipmentController@storeEquipment')->middleware('admin')->name('equipment.store');


//Route::get('/image/create', 'App\Http\Controllers\ImageController@createImage')->middleware('admin')->name('image.create'); //only admins have access to this
//Route::post('StoreImage', 'App\Http\Controllers\ImageController@storeImage')->name('image.store');

Route::get('successGym', 'App\Http\Controllers\SuccessController@message' )->name('sucessGym');
Route::get('success','App\Http\Controllers\SuccessController@display' )->name('display');



//Admin Interface
Route::middleware(['auth', 'admin'])->group(function () {
    
Route::get('AdminWelcome',  'App\Http\Controllers\AdminPanelController@AdminWelcome' )->name('AdminWelcome');
Route::get('AdminFirst', 'App\Http\Controllers\AdminPanelController@AdminFirst')->name('AdminFirst');
Route::get('AdminBusiness/{Gym_id}', 'App\Http\Controllers\AdminPanelController@AdminBusiness')->name('AdminBusiness');
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
});


//searching
Route::get('search','App\Http\Controllers\searchcontroller@search')->name('search');
Route::get('searchClass/{Gym_id}','App\Http\Controllers\searchcontroller@searchClass')->name('searchClass');
Route::get('searchOffering/{Gym_id}','App\Http\Controllers\searchcontroller@searchOffering')->name('searchOffering');
Route::get('searchEquipment/{Gym_id}','App\Http\Controllers\searchcontroller@searchEquipment')->name('searchEquipment');
Route::get('searchMembership/{Gym_id}','App\Http\Controllers\searchcontroller@searchMembership')->name('searchMembership');
Route::get('searchUser','App\Http\Controllers\searchcontroller@searchUser')->name('searchUser');
Route::get('searchClassOffering/{Gym_id}','App\Http\Controllers\searchcontroller@searchClassOffering')->name('searchClassOffering');

//emails
/*
Route::get('createMail/{Gym_id}', function(){
    return view ('writeEmail');
})->name('createMail');*/
Route::get('createMail/{Gym_id}', 'App\Http\Controllers\AdminPanelController@adminWriteEmail')->name('createMail'); //for admin to send emails

Route::get('sendMail/{Gym_id}', 'App\Http\Controllers\MailController@sendMail')->name('sendMail');
Route::get('clientSendMail/{Gym_id}', 'App\Http\Controllers\MailController@clientSendMail')->name('clientSendMail');
Route::get('subscribe/{Gym_id}', 'App\Http\Controllers\MailController@subscribe')->name('subscribe');

//to save gym as favourite/ bookmark gym
Route::post('storeFavGym', 'App\Http\Controllers\FavouriteGymController@storeFavGym')->name('storeFavGym');

//user profile
Route::get('userProfile', 'App\Http\Controllers\UserProfileController@userProfile')->name('userProfile');
Route::match(['get','post'],'editUserDetails', 'App\Http\Controllers\UserProfileController@editUserDetails')->name('editUserDetails'); //This route was written with the assistance of AI. I was getting an error regarless of whether I was using get or post. AI suggested I use both.
Route::post('UpdateUser','App\Http\Controllers\UserProfileController@UpdateUser')->name('UpdateUser');

//maps
Route::get('/maps', function () {
    return view('maps');
});