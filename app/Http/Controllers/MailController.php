<?php

namespace App\Http\Controllers;
use App\Mail\Marketing;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;


class MailController extends Controller
{
 /*
    public function createMail(){

        
        return view('writeEmail');
       


    }*/
    public function sendMail(Request $req){
/*
        $req->validate([
            'subject'=> 'required!string|max:100',
            'message'=> 'required|string',
        ]) ; */      
        $subject= $req->subject;
        $message= $req->message;
        //return view('MarketingEmail', compact('subject', 'message'));
        //changes to be made: gyms will send gyms to people to subscribed to them. need new table for that? check laracast.
        //need to set up something so that gyms can type the email they want to send, then pass that to the view/controller to be sent. 
        
        //Mail::to('rigodonamariah16@gmail.com')->subject($subject)-> send(new Marketing());
     Mail::to('rigodonamariah16@gmail.com')->send(new Marketing($subject, $message));
    
     return redirect()->route('createMail')->with('success', 'Email successfully sent.');
    }
}
