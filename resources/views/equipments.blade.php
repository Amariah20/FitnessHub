@extends('layouts.app')

@section('content')
<div class="equipments">
<h1>Equipments</h1>

<div class="row row-cols-1 row-cols-md-3 g-4">
  

@foreach($equipments as $equipment)
<div class="col">
    <div class="card border-secondary mb-3" style="width: 75%;">
            <div class="card-header">
            {{$equipment->name}}
            </div>
        <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Equipment</h6>
                <p class="card-text">{{$equipment->description}}</p>

    </div>
</div>
</div>

@endforeach
</div>

@endsection