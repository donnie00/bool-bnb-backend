@extends('layouts.dashboard')

@section('content')
   <h1>Messages</h1>

   @foreach ($messages as $apartment => $message)
      <h5>Annuncio: {{ $apartment }}</h5>

      <div class="card p-3 mb-3">
         <ol>
            @foreach ($message as $singleMessage)
               <li>
                  <p class="fw-bold">{{ $singleMessage['sender'] }}</p>
                  <p>Email: {{ $singleMessage['email'] }}</p>
                  <p>Subject: {{ $singleMessage['subject'] }}</p>
                  <p>Message: {{ $singleMessage['message'] }}</p>
               </li>
            @endforeach
         </ol>
      </div>
   @endforeach

   </body>
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
@endsection
