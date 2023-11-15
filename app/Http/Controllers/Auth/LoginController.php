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

   //I used this for help for showing different login screens: https://www.youtube.com/watch?v=xhngdDtJOUY
    

   protected function authenticated(Request $req,$user){
       
      
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
