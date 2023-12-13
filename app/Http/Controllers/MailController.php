<?php

namespace App\Http\Controllers;
use App\Mail\Marketing;
use App\Mail\clientSendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Gym;
use App\Models\subscription;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Notification as FacadesNotification;

//used this for help: https://www.youtube.com/watch?v=xigpoxOW1MY 

class MailController extends Controller
{
 

  

    public function sendMail(Request $req, $Gym_id){

           
        $subject= $req->subject;
        $message= $req->message;
     

        $subscribers= subscription::where('gym_id',$Gym_id)->pluck('userEmail');

        foreach($subscribers as $subscriber){
            Mail::to($subscriber)->send(new Marketing($subject, $message));
        }
        
     
    // Mail::to('rigodonamariah16@gmail.com')->send(new Marketing($subject, $message));
     return redirect()->route('createMail', ['Gym_id' =>  $Gym_id])->with('success', 'Email successfully sent.');

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

    public function subscribe($Gym_id, Request $req){

        $email= $req->email;

        $subscriber = new subscription();
        $subscriber->gym_id = $Gym_id;
        $subscriber->userEmail= $email;
        $subscriber->save();
        return redirect()->route('gymIndividual',['Gym_id'=>$Gym_id])->with('success', 'You are now subscribed.');
        //successful subscribe message before the button. put it zs par lao button?
        
    }
}
