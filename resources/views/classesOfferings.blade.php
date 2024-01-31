@extends('layouts.app')

@section('content')


<div class="input-box">
<form method="GET"  action="{{route('searchClassOffering',['Gym_id' => $gym->Gym_id] )}}" id="search" >
<input type="text" placeholder="Find something" name="search" id="search-box" class="form-control">
   <button style="background: none; border:none;"><i class="fa fa-search"></i></button>  
 
</form>
</div>



<div class="classes_offerings">
    <h1>Classes and Services</h1>
    @if($classes->count()>0)
    <div class="class_list">   
        <h2>Classes</h2>
            @foreach($classes as $class)
            <a href= "{{route('classShow', ['Class_id'=>$class->Class_id])}}"> <p>{{ $class->name }}</p></a>
            
                <hr class="review_line">
            @endforeach
    </div>
    @endif
    @if($offerings->count()>0)
    <div class="offerings">
        <h2>Services:</h2>
        @foreach($offerings as $offering)
        <a href= "{{route('offeringShow', ['Offering_id'=>$offering->offerings_id])}}">   <p>{{ $offering->name }}</p></a>
            
        <hr class="review_line">
        @endforeach
    </div>
    @endif
</div>
@endsection