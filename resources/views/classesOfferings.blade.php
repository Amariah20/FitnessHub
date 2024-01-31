@extends('layouts.app')

@section('content')
<!--bootstrap for cards:https://getbootstrap.com/docs/4.0/components/card/-->


<div class="input-box">
<form method="GET"  action="{{route('searchClassOffering',['Gym_id' => $gym->Gym_id] )}}" id="search" >
<input type="text" placeholder="Search this page" name="search" id="search-box" class="form-control">
   <button style="background: none; border:none;"><i class="fa fa-search"></i></button>  
 
</form>
</div>



<div class="classes_offerings">
    <h1>Classes and Services</h1>

  <div class="row row-cols-1 row-cols-md-3 g-4">
  
    @foreach($classes as $class)
    <div class="col">
    <div class="card border-secondary mb-3" style="width: 75%;">
            <div class="card-header">
                {{ $class->name }}

            </div>
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Class</h6>
                <p class="card-text">SCR {{$class->price}}</p>
                <button class="btn btn-primary"> <a href="{{route('classShow', ['Class_id'=>$class->Class_id])}}" class="card-link">View Class</a></button>
             </div>
    </div>
    </div>


    @endforeach
    
   
     
     
       
        
    
    @foreach($offerings as $offering)
    <div class="col">
    <div class="card border-secondary mb-3" style="width: 75%;">
      
        <div class="card-header">
            {{ $offering->name }}
        </div>
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Service</h6>
                <p class="card-text">SCR {{$offering->price}}</p>
                <button class="btn btn-primary"> <a href="{{route('offeringShow', ['Offering_id'=>$offering->offerings_id])}}" class="card-link">View Service</a></button>
 
            </div>
    </div>
    </div>
   

@endforeach
  </div>  
</div>


        
        
    
    
   
</div>
@endsection