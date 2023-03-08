@extends('layouts.dashboard')

@section('content')
   <h3>Hai {{ $userApartmentsCount }} appartamenti in totale</h3>
   <h3>Ultimi aggiunti: </h3>
   <ul>
      @foreach ($lastApartments as $apartment)
         <li>{{ $apartment['title'] }}</li>
      @endforeach
   </ul>

   <h3>Hai {{ $totalMessages }} messaggi in totale</h3>
   <a href="{{ route('Admin.dashboard.messages') }}">Visualizza tutti</a>
@endsection
