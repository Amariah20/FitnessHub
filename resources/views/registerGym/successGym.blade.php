@extends('layouts.app')

@section('content')
<!--NOT WORKING. END OF FILE ERROR-->
<form method="GET" action="{{route('display')}}">
<h1>Congratulations your fitness center has been published on Fitness Hub</h1>
<div class="mb">
    
    <label class="label">Which gym do you want to view?</label>
    <select name="SelectedGymID">
    <option>Select Gym</option>
            @foreach($gym as $gym)
                
                <option value="{{ $gym->Gym_id }}">{{ $gym->name }}</option>
            @endforeach

    </select>
</div>

   

    
    <button type="submit">View</button>
    </form>

@endsection