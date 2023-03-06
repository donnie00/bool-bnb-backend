@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card m-auto" style="width: 18rem;">
            <img class="card-img-top" src="{{ url('/images/img_app_test.jpg') }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $apartment->title }}</h5>
                <p class="card-text">{{ $apartment->description }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> <b>Rooms qty: </b>{{ $apartment->rooms_qty }} </li>
                <li class="list-group-item"> <b>Bathrooms qty: </b>{{ $apartment->bathrooms_qty }} </li>
                <li class="list-group-item"> <b>Beds qty: </b>{{ $apartment->beds_qty }} </li>
            </ul>
            <div class="card-body">

                <form action="{{ route('Admin.apartments.destroy', $apartment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger w-100">Delete</button>

                </form>
                <a href="{{ route('Admin.apartments.edit', $apartment->id) }}" class="btn btn-success">Edit</a>
            </div>
        </div>
    </div>
@endsection
