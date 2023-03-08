<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>@yield('title')</title>

   <!-- Fonts -->
   <link rel="dns-prefetch" href="//fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

   <!-- Usando Vite -->
   @vite(['resources/js/app.js'])
</head>

<body class=" dashboard-container bg-secondary">

   <div id="app" class="">
      <div class="dashboard-container d-flex justify-content-end">

         @include('structure.dashboardAside')

         <main class="dashboard w-100 ps-5 p-4 overflow-x-hidden">
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


            {{-- qua ci starebbe l'if --}}
            @yield('content')
         </main>
      </div>
   </div>

</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

</html>
