<h1>Welcome Admin</h1>

<form method="get" action="{{ route('AdminWelcome')}}">
<h2>Please select which gym you want to view to get started </h2>


    @csrf 
    
    <select name="SelectedGymID">
        <option>Select Gym</option>
        @foreach($gym as $gym)
            <option value="{{ $gym->Gym_id }}">{{ $gym->name }}</option>
        @endforeach
    </select>

    <button type="submit">Get Started</button>
</form>



<p>change welcome admin to admin name</p>