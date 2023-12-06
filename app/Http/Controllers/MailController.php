<?php

namespace App\Http\Controllers;
use App\Mail\Marketing;
use App\Mail\clientSendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Gym;

//used this for help: https://www.youtube.com/watch?v=xigpoxOW1MY 

class MailController extends Controller
{
 
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


    public function clientSendMail(Request $req, $Gym_id){
        $name = $req->name;
        $email= $req->email;
        $number= $req->number;
        $subject= $req->subject;
        $message= $req->message;

        $gym= Gym::where('Gym_id', $Gym_id)->first();


        $gymEmail= $gym->email;
        Mail::to($gymEmail)->send(new clientSendMail( $name,$email,$number,  $subject,  $message ));
        return redirect()->route('gymIndividual',['Gym_id'=>$gym->Gym_id])->with('success', 'Email successfully sent.');



    }
}
