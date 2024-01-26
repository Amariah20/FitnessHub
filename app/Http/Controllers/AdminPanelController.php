<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gym;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\redirect;
use App\Http\Controllers\view;
use App\Models\Classes;
use App\Models\Equipment;
use App\Models\Membership;
use App\Models\Offerings;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClassValidation;
use App\Http\Requests\EquipmentValidation;
use App\Http\Requests\MembershipValidation;
use App\Http\Requests\OfferingValidation;
use App\Http\Requests\updateGymValidation;
use App\Http\Requests\updateClassValidation;
use App\Http\Requests\updateMembershipValidation;
use App\Http\Requests\updateEquipmentValidation;
use App\Http\Requests\updateOfferingValidation;
use ConsoleTVs\Profanity\Facades\Profanity;



class AdminPanelController extends Controller
{

//protected $currentGymId;
    
 public function logout(){
    Auth::guard('web')->logout();
    return redirect('/');
 }


 /**NEED A METHOD TO STORE THE PROFANITY CONTROLLER. IF THAT METHOD RETURNS TRUE, THEN WE UPDATE OR ADD SOMETHING.
  * METHOD TAKES USER INPUT AS PARAMETER, FROM THE OTHER METHODS. THEN IT TURNS TRUE OR FALSE. EACH METHOD WILL CALL
  THE PROFANITYFILTER METHOD BEFORE IT STORES/UPDATES SOMETHING
 **/
   public function profanityFilter($req){
        /**put all input values ($req->all()) into an array.  iterate over it. as long as coun<array.length, 
         * input the value into profitanity checker. test if clear()==true, if so, check next array value. else, stop the loop and
         * throw an exception
        **/    

        $allInput= $req->all();
        foreach($allInput as $value){
            //dd($value);
            $clean =Profanity::blocker($value)->clean();
            if($clean==false){
       
              
             return false;
            }
            
        }
        return true;
   }


   public function AdminFirst(Request $req){
        $user = Auth::user(); // Get the logged in user
       
        $gym = $user->gym; // Retrieve the gyms associated with the user

        $Gym_Id= $req->SelectedGymID;

        
        //$this->currentGymId = $req->SelectedGymID;
       //if (($Gym_Id== null)) {
            
      //      return redirect()->back()->withErrors(['error' => 'Please select a gym to proceed.']);
       //}

        
      //  return view('AdminWelcome', compact('gym', 'Gym_Id'));
      //return view("{{route('AdminWelcome', ['Gym_id'=>$Gym_Id])}}" , compact('gym', 'Gym_Id'));
     // return redirect()->route('AdminWelcome', ['Gym_id'=>$Gym_Id]);
     //return redirect()->route('AdminWelcome/{$Gym_Id}');
     return view ('AdminInterface.adminFirst', compact ('Gym_Id','gym', 'user'));
    }

    public function AdminWelcome(Request $req)
    {
        $user = Auth::user(); 
        $Gym_id= $req->SelectedGymID;

        if (($Gym_id=="Select")) {
            
                return redirect()->back()->withErrors(['error' => 'Please select a gym to proceed.']);
        }

        
      //  $Gym_id = $req->Gym_id;
        //$this->currentGymId = $Gym_id;
        $gym = Gym::where('Gym_id', $Gym_id)->first();
        $classes = Classes::where('gym_id', $Gym_id)->get();
        $offerings =  Offerings::where('gym_id',$Gym_id)->get();
        $memberships= Membership::where('gym_id', $Gym_id)->get();


       
       // return redirect()->route('AdminInterface.adminWelcome',compact('Gym_id' ));
        //return view('AdminInterface.adminWelcome', compact('Gym_id'));
        return view('AdminInterface.adminWelcome', compact('Gym_id', 'gym', 'classes', 'offerings','memberships', 'user'));
    }

    public function AdminClass(Request $req, $Gym_id)
    {
        //dd($Gym_id);
        $user = Auth::user();
        
        $classes = Classes::where('Gym_id', $Gym_id)->get();
 
    
        return view('AdminInterface.adminClass', compact('Gym_id','classes', 'user'));
    }
   
    public function AdminOffering (Request $req, $Gym_id){
        $user = Auth::user();
        $offering= Offerings::where('Gym_id', $Gym_id)->get();

        return view('AdminInterface.adminOffering', compact ('Gym_id', 'offering', 'user'));
    }

    public function AdminMembership (Request $req, $Gym_id){
        $user = Auth::user();
        $memberships= Membership::where('Gym_id', $Gym_id)->get();

        return view('AdminInterface.adminMembership', compact ('Gym_id', 'memberships', 'user'));

    }

    public function AdminEquipment (Request $req, $Gym_id){
        $user = Auth::user();
        $equipments= Equipment::where('Gym_id', $Gym_id)->get();

        return view('AdminInterface.adminEquipment', compact ('Gym_id', 'equipments', 'user'));

    }

    //I used this for help with updating: https://www.fundaofwebit.com/laravel-8/how-to-edit-update-data-in-laravel 

    public function EditGym($Gym_id){
        $user = Auth::user();
       // $gym = Gym::find($Gym_id);
       $gym = Gym::where('Gym_id', $Gym_id)->first();
       $Gym_id= $Gym_id;
        return view ('AdminInterface.editGym', compact('gym', 'Gym_id', 'user'));

    }

    public function UpdateGym(updateGymValidation $req,$Gym_id){

       
     try{


        $clean = $this->profanityFilter($req);

        if ($clean == true){

        $gym = Gym::where('Gym_id', $Gym_id)->first();    
        //$gym->Gym_id= $Gym_id;
       // $gym->name= $req->name;
       $validate = $req->validated();
       if ($validate ==true){
        $gym->description= $req-> description;
        $gym->location= $req-> location;
        $gym->opening_hours= $req-> opening_hours;
        $gym->phone_number= $req-> phone_number;
        $gym->email= $req-> email;
        $gym->instagram= $req->instagram;
        $gym->facebook= $req->facebook;
        $gym->general_location= $req->general_location;
        $gym->user_id = $req->user()->id; 
        $gymFolder = 'public/images/uploaded/gym_' .  $gym->user_id. $gym->name; //gym Id has not been created yet. 

            // checking that subfolder exists, and if not, create it
            if (!file_exists($gymFolder)) {
                mkdir($gymFolder, 0755, true);
            }
           
           if($req->hasfile('logo')){
            $pic=$req->file('logo');
            $extension= $pic->getClientOriginalExtension();
            $logo= time().'._logo.'.$extension;
            $pic->move($gymFolder, $logo);
            $gym->logo=$logo;
           }

           if($req->hasfile('banner')){
            $pic=$req->file('banner');
            $extension= $pic->getClientOriginalExtension();
            $banner= time().'._banner.'.$extension;
            $pic->move($gymFolder, $banner);
            $gym->banner= $banner;
           }
           if($req->hasfile('extra_image')){
            $pic=$req->file('extra_image');
            $extension= $pic->getClientOriginalExtension();
            $extra= time().'._extra_image.'.$extension;
            $pic->move($gymFolder, $extra);
            $gym->extra_image=$extra;
           }
        }
    
   

        $gym->update();
    
        //return('done');
        //return redirect()->route('AdminWelcome', compact('Gym_id', 'gym'))->with('Success','Gym Updated Successfully');
        //return redirect()->route('AdminWelcome', compact('Gym_id'))->with('Success','Gym Updated Successfully');
        return redirect()->route('AdminWelcome', ['SelectedGymID' => $Gym_id])->with('Success', 'Gym Updated Successfully');

        }

        else if ($clean == false){

            return redirect()->back()->withErrors(['Error','Inappropriate language detected in input.']);
        }
    } catch (\Exception $e){
        $error= "An error occured:". $e->getMessage();
        //return view ('gymIndividual', compact('error'));
        return redirect()->back()->withErrors(['error'=>$error]);
    }

    }

    public function EditClass($Class_id){
        // $gym = Gym::find($Gym_id);
        //$gym = Gym::where('Gym_id', $Gym_id)->first();
        $class= Classes::where('Class_id', $Class_id)->first();
        $Gym_id= $class->gym_id;
        $user = Auth::user();

         return view ('AdminInterface.editClass', compact('class', 'Gym_id', 'user'));
 
     }

     public function UpdateClass(updateClassValidation $req,$Class_id){

        try{

            $clean = $this->profanityFilter($req);

            if ($clean == true){
            $validate = $req->validated();
            if ($validate ==true){
                    $class= Classes::where('Class_id', $Class_id)->first();
                    $class->name = $req-> name;
                    $class->price = $req->price;
                    $class->description =  $req-> description;
                    $class-> capacity= $req-> capacity;
                    $class->duration=  $req-> duration;
                    $class->location=  $req-> location;
                    $class->schedule= $req-> schedule;
            }
        $class->update();
        return redirect()->route('AdminClass', ['Gym_id' => $class->gym_id])->with('Success', 'Class Updated Successfully');

    }

    else if ($clean == false){

        return redirect()->back()->withErrors(['Error','Inappropriate language detected in input.']);
    }
    } catch (\Exception $e){
        $error= "An error occured:". $e->getMessage();
        //return view ('gymIndividual', compact('error'));
        return redirect()->back()->withErrors(['error'=>$error]);
    }

     }

     public function EditMembership($Membership_id){
        
        $membership= Membership::where('membership_id', $Membership_id)->first();
        $Gym_id= $membership->gym_id;
        $user = Auth::user();
         return view ('AdminInterface.editMembership', compact('membership', 'Gym_id', 'user'));
 
     }

     public function UpdateMembership(UpdateMembershipValidation $req, $Membership_id){

        try{

            $clean = $this->profanityFilter($req);

            if ($clean == true){

            $validate = $req->validated();
            if ($validate ==true){
                $membership= Membership::where('membership_id', $Membership_id)->first();
                $membership->name= $req->name;
                $membership->description= $req->description;
                $membership->price=$req->price;
                $membership->membership_type=$req->membership_type;
            }
        $membership->update();

        return redirect()->route('AdminMembership', ['Gym_id' => $membership->gym_id] )->with('Success', 'Membership updated successfully');
   
    }

    else if ($clean == false){

        return redirect()->back()->withErrors(['Error','Inappropriate language detected in input.']);
    }
    } catch (\Exception $e){
        $error= "An error occured:". $e->getMessage();
        //return view ('gymIndividual', compact('error'));
        return redirect()->back()->withErrors(['error'=>$error]);
    } 
    }


     public function EditOffering($Offering_id){
        
        $offering= Offerings::where('offerings_id', $Offering_id)->first();
        $Gym_id= $offering->gym_id;
        $user = Auth::user();
         return view ('AdminInterface.editOffering', compact('offering', 'Gym_id', 'user'));
 
     }

     public function UpdateOffering(UpdateOfferingValidation $req, $Offering_id){

        try{

            $clean = $this->profanityFilter($req);

            if ($clean == true){

            $validate = $req->validated();
            if ($validate ==true){
                $offering= Offerings::where('offerings_id', $Offering_id)->first();
                $offering->name= $req->name;
                $offering->description= $req->description;
                $offering->price=$req->price;
            }
        $offering->update();

        return redirect()->route('AdminOffering', ['Gym_id' => $offering->gym_id] )->with('Success', 'Offering updated successfully');
        } else if ($clean == false){

            return redirect()->back()->withErrors(['Error','Inappropriate language detected in input.']);
        }

    } catch (\Exception $e){
        $error= "An error occured:". $e->getMessage();
        //return view ('gymIndividual', compact('error'));
        return redirect()->back()->withErrors(['error'=>$error]);
    }
    }


     public function EditEquipment($Equipment_id){
        
        $equipment= Equipment::where('equipment_id', $Equipment_id)->first();
        $Gym_id= $equipment->gym_id;
        $user = Auth::user();
         return view ('AdminInterface.editEquipment', compact('equipment', 'Gym_id', 'user'));
 
     }

     public function UpdateEquipment(UpdateEquipmentValidation $req, $Equipment_id){

        try{

            $clean = $this->profanityFilter($req);

            if ($clean == true){

            $validate = $req->validated();
            if ($validate ==true){
                $equipment= Equipment::where('equipment_id', $Equipment_id)->first();
                $equipment->name= $req->name;
                $equipment->description= $req->description;
            }
       
        $equipment->update();

        return redirect()->route('AdminEquipment', ['Gym_id' => $equipment->gym_id] )->with('Success', 'Equipment updated successfully');
       
    } else if ($clean == false){

        return redirect()->back()->withErrors(['Error','Inappropriate language detected in input.']);
    }
    
    } catch (\Exception $e){
        $error= "An error occured:". $e->getMessage();
        //return view ('gymIndividual', compact('error'));
        return redirect()->back()->withErrors(['error'=>$error]);
    }
    }



     public function AdminCreateClass(Request $req, $Gym_id){
        
        $Gym_id= $Gym_id;
        $user = Auth::user();   
        return view('AdminInterface.AdminAddClass',['Gym_id'=> $Gym_id], compact ('user'));
 }

     public function AdminClassStore(ClassValidation $req, $Gym_id){


            try{ 

                $clean = $this->profanityFilter($req);

                if ($clean == true){


                $validate = $req->validated();
                if ($validate ==true){
                    $ClassName = $req-> name;
                    $ClassLocation= $req-> location;
                    $ClassPrice= $req->price;
                    $ClassDescription = $req-> description;
                    $ClassCapacity= $req-> capacity;
                    $ClassDuration= $req-> duration;
                    $ClassSchedule= $req-> schedule;
                }

                $NewClass = new \App\Models\Classes();
                $NewClass->name = $ClassName;
                $NewClass->price = $ClassPrice;
                $NewClass->description = $ClassDescription;
                $NewClass->gym_id = $Gym_id;
                $NewClass-> capacity= $ClassCapacity;
                $NewClass->duration=  $ClassDuration;
                $NewClass->location=  $ClassLocation;
                $NewClass->schedule= $ClassSchedule;
    
                $NewClass->save();
                return redirect()->route('AdminClass', ['Gym_id' => $Gym_id])->with('Success', 'Class Added Successfully');
           
            } else if ($clean == false){

                return redirect()->back()->withErrors(['Error','Inappropriate language detected in input.']);
            }
           
            } catch (\Exception $e){
                $error= "An error occured:". $e->getMessage();
                //return view ('gymIndividual', compact('error'));
                return redirect()->back()->withErrors(['error'=>$error]);
            }

     }

     public function AdminCreateMembership(Request $req, $Gym_id){
        
        $Gym_id= $Gym_id;
        $user = Auth::user();   
        return view('AdminInterface.AdminAddMembership',['Gym_id'=> $Gym_id], compact('user'));
    }

    public function AdminMembershipStore(MembershipValidation $req, $Gym_id){

        try{

            $clean = $this->profanityFilter($req);

            if ($clean == true){

            $validate = $req->validated();
            if ($validate ==true){
                    $MembershipName = $req-> name;
                    $MembershipPrice= $req->price;
                    $MembershipDescription = $req-> description;
                    $MembershipType= $req->membership_type;
            }


        
      

        $NewMembership = new \App\Models\Membership();
        $NewMembership->name = $MembershipName;
        $NewMembership->price = $MembershipPrice;
        $NewMembership->description =  $MembershipDescription;
        $NewMembership->membership_type = $MembershipType;
        $NewMembership->gym_id = $Gym_id;

        $NewMembership->save();
    
        return redirect()->route('AdminMembership', ['Gym_id' => $Gym_id] )->with('Success', 'Membership added successfully');
    
    } else if ($clean == false){

        return redirect()->back()->withErrors(['Error','Inappropriate language detected in input.']);
    }
    
    } catch (\Exception $e){
        $error= "An error occured:". $e->getMessage();
        //return view ('gymIndividual', compact('error'));
        return redirect()->back()->withErrors(['error'=>$error]);
    }
    }

    public function AdminCreateOffering(Request $req, $Gym_id){
        
        $Gym_id= $Gym_id;   
        $user = Auth::user();
        return view('AdminInterface.AdminAddOffering',['Gym_id'=> $Gym_id], compact('user'));
    }

    public function AdminOfferingStore(OfferingValidation $req, $Gym_id){

        try{

            $clean = $this->profanityFilter($req);

            if ($clean == true){

            $validate = $req->validated();
            if ($validate ==true){
                    $OfferingName = $req-> name;
                    $OfferingPrice= $req->price;
                    $OfferingDescription = $req-> description;
            }
                      
          

            $NewOffering = new \App\Models\Offerings();
            $NewOffering->name = $OfferingName;
            $NewOffering->price = $OfferingPrice;
            $NewOffering->description =  $OfferingDescription;
            $NewOffering->gym_id = $Gym_id;

            $NewOffering->save();
            return redirect()->route('AdminOffering', ['Gym_id' => $Gym_id] )->with('Success', 'Offering added successfully');
       
        } else if ($clean == false){

            return redirect()->back()->withErrors(['Error','Inappropriate language detected in input.']);
        }
       
        } catch (\Exception $e){
            $error= "An error occured:". $e->getMessage();
            //return view ('gymIndividual', compact('error'));
            return redirect()->back()->withErrors(['error'=>$error]);
        }

    }

    public function AdminCreateEquipment(Request $req, $Gym_id){
        $user = Auth::user();
        $Gym_id= $Gym_id;   
        return view('AdminInterface.AdminAddEquipment',['Gym_id'=> $Gym_id], compact('user'));
    }

    public function AdminEquipmentStore(EquipmentValidation $req, $Gym_id){
        try{


            $clean = $this->profanityFilter($req);

            if ($clean == true){

            $validate = $req->validated();
            if ($validate ==true){
                    $EquipmentName = $req-> name;
            
                    $EquipmentDescription = $req-> description;
            }
                            
          

            $NewEquipment = new \App\Models\Equipment();
            $NewEquipment->name = $EquipmentName;
       
            $NewEquipment->description =  $EquipmentDescription;
            $NewEquipment->gym_id = $Gym_id;

            $NewEquipment->save();
            return redirect()->route('AdminEquipment', ['Gym_id' => $Gym_id] )->with('Success', 'Equipment added successfully');
        
        } else if ($clean == false){

            return redirect()->back()->withErrors(['Error','Inappropriate language detected in input.']);
        }
        
        } catch (\Exception $e){
            $error= "An error occured:". $e->getMessage();
            //return view ('gymIndividual', compact('error'));
            return redirect()->back()->withErrors(['error'=>$error]);
        }

    }

    public function DeleteClass($Class_id){
     

     
        $class= Classes::where('Class_id',$Class_id)->first();
         $Gym_id= $class->gym_id;

       

        $class->delete();
    
        return redirect()->route('AdminClass', ['Gym_id' =>  $Gym_id])->with('Success', 'Class Deleted Successfully');

    }

    
    public function DeleteMembership($Membership_id){
        $membership= Membership::where('membership_id',$Membership_id)->first();
        $Gym_id= $membership->gym_id;
       

        $membership->delete();
    
        return redirect()->route('AdminMembership', ['Gym_id' =>  $Gym_id])->with('Success', 'Membership Deleted Successfully');

    }

    public function DeleteOffering($Offering_id){
        $offering= Offerings::where('Offerings_id',$Offering_id)->first();
        $Gym_id= $offering->gym_id;
       

        $offering->delete();
    
        return redirect()->route('AdminOffering', ['Gym_id' =>  $Gym_id])->with('Success', 'Offering Deleted Successfully');

    }

    public function DeleteEquipment($Equipment_id){
        
        $equipment= Equipment::where('equipment_id',$Equipment_id)->first();
        $Gym_id= $equipment->gym_id;
       

        $equipment->delete();
    
        return redirect()->route('AdminEquipment', ['Gym_id' =>  $Gym_id])->with('Success', 'Equipment Deleted Successfully');

    }

    public function adminWriteEmail(Request $req, $Gym_id){
        $user = Auth::user();
            
        return view('AdminInterface.writeEmail', compact('Gym_id', 'user'));
}

public function AdminBusiness(Request $req, $Gym_id){
    
    
    $gym = Gym::where('Gym_id', $Gym_id)->first();
    $user = Auth::user(); 
    return view('AdminInterface.adminBusinessInfo', compact('gym','user','Gym_id'));
}
}
    

   

