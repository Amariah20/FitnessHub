<div class="container">
<div class="card-header">Edit Membership</div>
<form method="POST" action="{{route('UpdateMembership',  ['Membership_id' => $membership->membership_id])}}"">
@csrf
@method("patch")

    <div class="mb">
        <label class="label">Membership Name</label>
        <input type="text" name="name" class="form-control" value="{{$membership->name}}" required>
    </div>
    <div class="mb">
        <label class="label">Price of Membership</label>
        <input type="number" name="price" class="form-control" value="{{$membership->price}}"  required>
    </div>
   
    <div class="mb">
        <label class="label">Write a brief description</label>
        <input class="form-control" name="description"  value="{{$membership->description}}" required></input>
    </div>

</div>

 
        <button type="submit">Update </button>

         
</form>
</div>