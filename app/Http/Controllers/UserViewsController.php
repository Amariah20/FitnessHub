<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//not currently using these. i put them in controller/auth/logincontroller but they don't work

class UserViewsController extends Controller
{
    public function index() {

        if (auth()->user()?->email == 'globaladmin@gmail.com') {
            return view('allUsers');

        }elseif (auth()->user()->is_admin) {
            return view('registerGym/getStarted');
        } //else {
           // return view('user');
       // }
    }
}
