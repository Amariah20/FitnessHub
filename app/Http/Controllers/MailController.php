<?php

namespace App\Http\Controllers;
use App\Mail\Discount;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;


class MailController extends Controller
{
    public function sendMail(){

        //changes to be made: gyms will send gyms to people to subscribed to them. need new table for that? check laracast.
        //need to set up something so that gyms can type the email they want to send, then pass that to the view/controller to be sent. 
        
        Mail::to('rigodonamariah16@gmail.com')->send(new Discount());
        
    }
}
