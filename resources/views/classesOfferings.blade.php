@extends('layouts.app')

@section('content')

<div class="classes_offerings">
    <h1>Classes and Offerings</h1>
    <div class="class_list">   
        <h2>Classes</h2>
            @foreach($classes as $class)
            <a href= "{{route('classShow', ['Class_id'=>$class->Class_id])}}"> <p>{{ $class->name }}</p></a>
            
                <hr class="review_line">
            @endforeach
    </div>
    <div class="offerings">
        <h2>Offerings:</h2>
        @foreach($offerings as $offering)
        <a href= "{{route('offeringShow', ['Offering_id'=>$offering->offerings_id])}}">   <p>{{ $offering->name }}</p></a>
            
        <hr class="review_line">
        @endforeach
    </div>
</div>
@endsection