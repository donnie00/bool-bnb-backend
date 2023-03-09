</html>
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
            @php
                $backendURL = 'http://127.0.0.1:8000';
                $frontendURL = 'http://localhost:5174';
            @endphp

            @include('structure.dashboardAside')

            <main class="dashboard w-100 ps-5 p-4 overflow-x-hidden">

                <h1>Ciao {{ $user->name }}</h1>
                @dump(Route::currentRouteName())
                @yield('content')
            </main>

        </div>
    </div>

</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

</html>
