@extends('layouts.form')

@section('content')
   <h1 class="m-0">Invia un messaggio al proprietario dell'appartamento</h1>
   <hr class="mb-5 mt-0">
   @if ($errors->any())

   <div class="alert alert-danger">
       {{-- lista errori da fixare --}}
       <ul>
              @if ($errors->has("sender"))
                  <li>Inserire il nome del mittente</li>
               @endif
              @if ($errors->has("email"))
                  <li>Inserire un'email per essere ricontattati</li>
               @endif
               @if ($errors->has("subject"))
                  <li>L'oggetto del messaggio è richiesto</li>
               @endif
               @if ($errors->has("message"))
                  <li>Il messaggio non può essere vuoto</li>
               @endif

       </ul>
   </div>
@endif

   <form action="{{ route('messages.store', $apartmentId) }}" method="POST">
      @csrf
      <div class="row">
         <div class="col-6">
            <div class="form-floating mb-3">
               <input type="text" class="form-control" name="sender" value="{{ $user->name ?? null }}"
                  placeholder="Enter your fulll name" />
               <label for="floatingInput">Nome</label>
            </div>
            <div class="form-floating mb-3">
               <input type="email" class="form-control" name="email" value="{{ $user->email ?? null }}"
                  placeholder="name@example.com" />
               <label for="floatingPassword">Email </label>
            </div>
            <div class="form-floating mb-3">
               <input type="text" class="form-control" name="subject" placeholder="name@example.com" />
               <label for="floatingInput">Oggetto</label>
            </div>
         </div>
         <div class="col-6">
            <div class="mb-3">
               <textarea class="form-control" name="message" rows="8" placeholder="Messaggio"></textarea>
            </div>
         </div>
      </div>
      <div class="form-buttons d-flex justify-content-between">
         <a href="{{ env('MY_FRONTEND_URL') . '/apartments/' . $apartmentId }}" class="me-3 btn btn-primary">
            &leftarrow; Torna all'appartamento
         </a>
         <div class="form-controls">
            <button type="reset" class="btn btn-dark me-2">
               Cancella
            </button>
            <button type="submit" class="btn btn-success">
               Invia
            </button>
         </div>
      </div>
   </form>
@endsection
