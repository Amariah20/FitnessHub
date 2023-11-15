<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   
   // protected $redirectTo = RouteServiceProvider::HOME; 

   protected function authenticated(Request $req,$user){
       // dd (!$user->is_admin && !$user->email = 'globaladmin@gmail.com');
      //dd($user->is_admin);
        if($user->email == 'globaladmin@gmail.com'){
            return redirect('/AdminAccess');
        }
        else if($user->is_admin==0){
            return redirect('gymAll');
        }
        else if($user->is_admin==1){
            return redirect('registerGym/getStarted');
        } 
        
        
   }

   /*added by me. these don't work
   protected function redirectTo(){
    if (auth()->user()?->email == 'globaladmin@gmail.com') {
        return view('/AdminAccess');

    }elseif (auth()->user()->is_admin) {
        return view('registerGym/getStarted');
    } else{
        return view('/');
    }
   }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
