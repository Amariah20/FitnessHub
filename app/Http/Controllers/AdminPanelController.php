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

class AdminPanelController extends Controller
{

//protected $currentGymId;
    
 public function logout(){
    Auth::guard('web')->logout();
    return redirect('/');
 }



   public function AdminFirst(Request $req){
        $user = Auth::user(); // Get the logged in user
       
        $gym = $user->gym; // Retrieve the gyms associated with the user

        $Gym_Id= $req->SelectedGymID;
        //$this->currentGymId = $req->SelectedGymID;
       
        
      //  return view('AdminWelcome', compact('gym', 'Gym_Id'));
      //return view("{{route('AdminWelcome', ['Gym_id'=>$Gym_Id])}}" , compact('gym', 'Gym_Id'));
     // return redirect()->route('AdminWelcome', ['Gym_id'=>$Gym_Id]);
     //return redirect()->route('AdminWelcome/{$Gym_Id}');
     return view ('AdminInterface.adminFirst', compact ('gym', 'user'));
    }

    public function AdminWelcome(Request $req)
    {
        $user = Auth::user(); 
        $Gym_id= $req->SelectedGymID;
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
        
        $classes = Classes::where('Gym_id', $Gym_id)->get();
 
    
        return view('AdminInterface.adminClass', compact('Gym_id','classes'));
    }
   
    public function AdminOffering (Request $req, $Gym_id){
        $offering= Offerings::where('Gym_id', $Gym_id)->get();

        return view('AdminInterface.adminOffering', compact ('Gym_id', 'offering'));
    }

    public function AdminMembership (Request $req, $Gym_id){
        $memberships= Membership::where('Gym_id', $Gym_id)->get();

        return view('AdminInterface.adminMembership', compact ('Gym_id', 'memberships'));

    }

    public function AdminEquipment (Request $req, $Gym_id){
        $equipments= Equipment::where('Gym_id', $Gym_id)->get();

        return view('AdminInterface.adminEquipment', compact ('Gym_id', 'equipments'));

    }

    //I used this for help with updating: https://www.fundaofwebit.com/laravel-8/how-to-edit-update-data-in-laravel 

    public function EditGym($Gym_id){
       // $gym = Gym::find($Gym_id);
       $gym = Gym::where('Gym_id', $Gym_id)->first();
        return view ('AdminInterface.editGym', compact('gym'));

    }

    public function UpdateGym(Request $req,$Gym_id){

       
     try{
        $gym = Gym::where('Gym_id', $Gym_id)->first();    
        //$gym->Gym_id= $Gym_id;
       // $gym->name= $req->name;
        $gym->description= $req-> description;
        $gym->location= $req-> location;
        $gym->opening_hours= $req-> opening_hours;
        $gym->phone_number= $req-> phone_number;
        $gym->email= $req-> email;
        $gym->instagram= $req->instagram;
        $gym->facebook= $req->facebook;
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

       
        $gym->update();
        //return('done');
        //return redirect()->route('AdminWelcome', compact('Gym_id', 'gym'))->with('Success','Gym Updated Successfully');
        //return redirect()->route('AdminWelcome', compact('Gym_id'))->with('Success','Gym Updated Successfully');
        return redirect()->route('AdminWelcome', ['SelectedGymID' => $Gym_id])->with('Success', 'Gym Updated Successfully');
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
         return view ('AdminInterface.editClass', compact('class'));
 
     }

     public function UpdateClass(Request $req,$Class_id){

        try{

        $class= Classes::where('Class_id', $Class_id)->first();
        $class->name = $req-> name;
        $class->price = $req->price;
        $class->description =  $req-> description;
        $class-> capacity= $req-> capacity;
        $class->duration=  $req-> duration;
        $class->location=  $req-> location;
        $class->schedule= $req-> schedule;

        $class->update();
        return redirect()->route('AdminClass', ['Gym_id' => $class->gym_id])->with('Success', 'Class Updated Successfully');
    } catch (\Exception $e){
        $error= "An error occured:". $e->getMessage();
        //return view ('gymIndividual', compact('error'));
        return redirect()->back()->withErrors(['error'=>$error]);
    }

     }

     public function EditMembership($Membership_id){
        
        $membership= Membership::where('membership_id', $Membership_id)->first();
         return view ('AdminInterface.editMembership', compact('membership'));
 
     }

     public function UpdateMembership(Request $req, $Membership_id){

        try{
        $membership= Membership::where('membership_id', $Membership_id)->first();
        $membership->name= $req->name;
        $membership->description= $req->description;
        $membership->price=$req->price;
        $membership->update();

        return redirect()->route('AdminMembership', ['Gym_id' => $membership->gym_id] )->with('Success', 'Membership updated successfully');
    } catch (\Exception $e){
        $error= "An error occured:". $e->getMessage();
        //return view ('gymIndividual', compact('error'));
        return redirect()->back()->withErrors(['error'=>$error]);
    } 
    }


     public function EditOffering($Offering_id){
        
        $offering= Offerings::where('offerings_id', $Offering_id)->first();
         return view ('AdminInterface.editOffering', compact('offering'));
 
     }

     public function UpdateOffering(Request $req, $Offering_id){

        try{
        $offering= Offerings::where('offerings_id', $Offering_id)->first();
        $offering->name= $req->name;
        $offering->description= $req->description;
        $offering->price=$req->price;
        $offering->update();

        return redirect()->route('AdminOffering', ['Gym_id' => $offering->gym_id] )->with('Success', 'Offering updated successfully');
    } catch (\Exception $e){
        $error= "An error occured:". $e->getMessage();
        //return view ('gymIndividual', compact('error'));
        return redirect()->back()->withErrors(['error'=>$error]);
    }
    }


     public function EditEquipment($Equipment_id){
        
        $equipment= Equipment::where('equipment_id', $Equipment_id)->first();
         return view ('AdminInterface.editEquipment', compact('equipment'));
 
     }

     public function UpdateEquipment(Request $req, $Equipment_id){

        try{
        $equipment= Equipment::where('equipment_id', $Equipment_id)->first();
        $equipment->name= $req->name;
        $equipment->description= $req->description;
       
        $equipment->update();

        return redirect()->route('AdminEquipment', ['Gym_id' => $equipment->gym_id] )->with('Success', 'Equipment updated successfully');
    } catch (\Exception $e){
        $error= "An error occured:". $e->getMessage();
        //return view ('gymIndividual', compact('error'));
        return redirect()->back()->withErrors(['error'=>$error]);
    }
    }



     public function AdminCreateClass(Request $req, $Gym_id){
        
        $Gym_id= $Gym_id;   
        return view('AdminInterface.AdminAddClass',['Gym_id'=> $Gym_id]);
 }

     public function AdminClassStore(Request $req, $Gym_id){

            try{ 
                $ClassName = $req-> name;
                $ClassLocation= $req-> location;
                $ClassPrice= $req->price;
                $ClassDescription = $req-> description;
                $ClassCapacity= $req-> capacity;
                $ClassDuration= $req-> duration;
                $ClassSchedule= $req-> schedule;
              

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
            } catch (\Exception $e){
                $error= "An error occured:". $e->getMessage();
                //return view ('gymIndividual', compact('error'));
                return redirect()->back()->withErrors(['error'=>$error]);
            }

     }

     public function AdminCreateMembership(Request $req, $Gym_id){
        
        $Gym_id= $Gym_id;   
        return view('AdminInterface.AdminAddMembership',['Gym_id'=> $Gym_id]);
    }

    public function AdminMembershipStore(Request $req, $Gym_id){

        try{
        $MembershipName = $req-> name;
        $MembershipPrice= $req->price;
        $MembershipDescription = $req-> description;


        
      

        $NewMembership = new \App\Models\Membership();
        $NewMembership->name = $MembershipName;
        $NewMembership->price = $MembershipPrice;
        $NewMembership->description =  $MembershipDescription;
        $NewMembership->gym_id = $Gym_id;

        $NewMembership->save();
        return redirect()->route('AdminMembership', ['Gym_id' => $Gym_id] )->with('Success', 'Membership added successfully');
    } catch (\Exception $e){
        $error= "An error occured:". $e->getMessage();
        //return view ('gymIndividual', compact('error'));
        return redirect()->back()->withErrors(['error'=>$error]);
    }
    }

    public function AdminCreateOffering(Request $req, $Gym_id){
        
        $Gym_id= $Gym_id;   
        return view('AdminInterface.AdminAddOffering',['Gym_id'=> $Gym_id]);
    }

    public function AdminOfferingStore(Request $req, $Gym_id){

        try{
        $OfferingName = $req-> name;
            $OfferingPrice= $req->price;
            $OfferingDescription = $req-> description;
                      
          

            $NewOffering = new \App\Models\Offerings();
            $NewOffering->name = $OfferingName;
            $NewOffering->price = $OfferingPrice;
            $NewOffering->description =  $OfferingDescription;
            $NewOffering->gym_id = $Gym_id;

            $NewOffering->save();
            return redirect()->route('AdminOffering', ['Gym_id' => $Gym_id] )->with('Success', 'Offering added successfully');
        } catch (\Exception $e){
            $error= "An error occured:". $e->getMessage();
            //return view ('gymIndividual', compact('error'));
            return redirect()->back()->withErrors(['error'=>$error]);
        }

    }

    public function AdminCreateEquipment(Request $req, $Gym_id){
        
        $Gym_id= $Gym_id;   
        return view('AdminInterface.AdminAddEquipment',['Gym_id'=> $Gym_id]);
    }

    public function AdminEquipmentStore(Request $req, $Gym_id){
        try{
             $EquipmentName = $req-> name;
     
            $EquipmentDescription = $req-> description;
                      
          

            $NewEquipment = new \App\Models\Equipment();
            $NewEquipment->name = $EquipmentName;
       
            $NewEquipment->description =  $EquipmentDescription;
            $NewEquipment->gym_id = $Gym_id;

            $NewEquipment->save();
            return redirect()->route('AdminEquipment', ['Gym_id' => $Gym_id] )->with('Success', 'Equipment added successfully');
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
            
        return view('AdminInterface.writeEmail', compact('Gym_id'));
}
}
    

   

