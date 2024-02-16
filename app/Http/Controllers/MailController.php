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
use ConsoleTVs\Profanity\Facades\Profanity;

//used this for help: https://www.youtube.com/watch?v=xigpoxOW1MY 

class MailController extends Controller
{
 

  

    public function sendMail(Request $req, $Gym_id){

      /**put all input values ($req->all()) into an array.  iterate over it. as long as coun<array.length, 
         * input the value into profitanity checker. test if clear()==true, if so, check next array value. else, stop the loop and
         * throw an exception
        **/    

        $allInput= $req->all();
        foreach($allInput as $value){
            //dd($value);
            $clean =Profanity::blocker($value)->clean();
            if($clean==false){
        return redirect()->back()->withErrors(['Error','Inappropriate language detected in input. Please change ' .$value])->withInput();
        
            }
            
        }

        $gym = Gym::where('Gym_id', $Gym_id)->first();
        //$gymNames= Gym::where('Gym_id',$Gym_id)->pluck('name'); //this returns an array because we're using pluck
        $gymName= $gym->name;
        $gymEmail= $gym->email;
        $subject= $req->subject;
        $message= $req->message;
     
        //getting the people who subscribed to this gym.  
        $subscribers= subscription::where('gym_id',$Gym_id)->pluck('userEmail');
       // $gymURL= route('gymIndividual', ['Gym_id' => $Gym_id]);


        foreach($subscribers as $subscriber){
            Mail::to($subscriber)->send(new Marketing($subject, $message, $gymName,  $gymEmail));
        }
        
     
    // Mail::to('rigodonamariah16@gmail.com')->send(new Marketing($subject, $message));
     return redirect()->route('createMail', ['Gym_id' =>  $Gym_id])->with('success', 'Email successfully sent.');

    }


    public function clientSendMail(Request $req, $Gym_id){

         /**put all input values ($req->all()) into an array.  iterate over it. as long as coun<array.length, 
         * input the value into profitanity checker. test if clear()==true, if so, check next array value. else, stop the loop and
         * throw an exception
        **/    

        $allInput= $req->all();
        foreach($allInput as $value){
            //dd($value);
            $clean =Profanity::blocker($value)->clean();
            if($clean==false){
        return redirect()->back()->withErrors(['Error','Inappropriate language detected in input. Please change ' .$value])->withInput();
        
            }
            
        }
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
