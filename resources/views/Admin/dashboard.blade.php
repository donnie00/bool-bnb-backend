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
            <h1>DASHBOARD</h1>
            <h2>Ciao {{ $user->name }}</h2>
            <h3>Hai {{ $userApartmentsCount }} appartamenti in totale</h3>
            <h3>Ultimi aggiunti: </h3>
            <ul>
               @foreach ($lastApartments as $apartment)
                  <li>{{ $apartment['title'] }}</li>
               @endforeach
            </ul>

            <h3>Hai {{ $totalMessages }} messaggi in totale</h3>
            <a href="{{ route('Admin.dashboard.messages') }}">Visualizza tutti</a>
            {{-- qua ci starebbe l'if --}}
            @yield('content')
         </main>
      </div>
   </div>

</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

</html>
