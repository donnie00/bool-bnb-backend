@extends("layouts.app")

@section("content") 
    <div class="container my-3">


    <form action="{{route("Admin.apartments.update", $apartment->id)}}" method="POST">
        @method("PUT")
        @csrf
        <div class="form-group mt-3">
          <label for="exampleInputEmail1">Title</label>
          <input type="text" class="form-control w-50 mb-3" id=""  value="{{ $apartment->title}}" name="title">
          
          <label for="exampleInputEmail1">address</label>
          <input type="text" class="form-control w-50 mb-3" value="{{$apartment->address}}"  name="address">
          <label for="exampleFormControlTextarea1">Description</label>
          <textarea class="form-control w-50" name="description" rows="3">{{$apartment->description}}</textarea>
          <label class="d-block" for="">Rooms qty</label>
          <input style="width: 50px" type="number" class="mb-3" value="{{$apartment->rooms_qty}}" name="rooms_qty">
          <label class="d-block" for="">beds qty</label>
          <input style="width: 50px" type="number" class="mb-3" value="{{$apartment->beds_qty}}"  name="beds_qty">
          <label class="d-block" for="1">Bathrooms qty</label>
          <input style="width: 50px" type="number" class="mb-3" value="{{$apartment->bathrooms_qty}}" name="bathrooms_qty">
          <label class="d-block" for="">Mq</label>
          <input style="width: 50px" type="number" class="mb-3" value="{{$apartment->mq}}"  name="mq">
          <label class="d-block" for="">Daily price</label>
          <input style="width: 100px" style="width: 50px" type="number" class="mb-3" value="{{$apartment->daily_price}}" step=".01" name="daily_price">
         
          
        </div>
        
        <button type="submit" class="btn btn-success">Update</button>
      </form>

    </div>
    
@endsection