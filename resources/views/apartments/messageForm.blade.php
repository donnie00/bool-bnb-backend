@extends('layouts.form')

@section('content')
   <h1>Form messaggi</h1>

   <form action="{{ route('messages.store', $apartmentId) }}" method="POST">
      @csrf
      <div class="row">
         <div class="col-lg-6 col-sm-12">
            <div class="form-floating mb-3">
               <input type="text" class="form-control" name="sender" value="{{ $user->name ?? null }}"
                  placeholder="Enter your fulll name" />
               <label for="floatingInput">Name</label>
            </div>
            <div class="form-floating mb-3">
               <input type="email" class="form-control" name="email" value="{{ $user->email ?? null }}"
                  placeholder="name@example.com" />
               <label for="floatingPassword">Email address</label>
            </div>
            <div class="form-floating mb-3">
               <input type="text" class="form-control" name="subject" placeholder="name@example.com" />
               <label for="floatingInput">Subject</label>
            </div>
         </div>
         <div class="col-lg-6 col-sm-12">
            <div class="mb-3">
               <textarea class="form-control" name="message" rows="8" placeholder="Message"></textarea>
            </div>
         </div>
      </div>
      <div class="form-buttons d-flex justify-content-between">
         <a href="{{ env('MY_FRONTEND_URL') . '/apartments/' . $apartmentId }}" class="me-3 btn btn-primary">
            &leftarrow; Back to apartment
         </a>
         <div class="form-controls d-flex gap-3 align-content-end">
            <button type="reset" class="btn btn-dark">
               Cancel
            </button>
            <button type="submit" class="btn btn-success ">
               Send
            </button>
         </div>
      </div>
   </form>
@endsection
