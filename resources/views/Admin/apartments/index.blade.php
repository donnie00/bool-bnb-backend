@extends('layouts.dashboard')

@section('content')
   @vite(['resources/js/deleteForm.js'])
   {{-- pezza perchè non lo recupera da dashboard layout?? --}}
   @php
      $frontendURL = env('MY_FRONTEND_URL');
   @endphp

   <div class="container" style="margin-left: 20px">
      <a class="btn btn-warning my-3" href="{{ route('Admin.apartments.create') }}">Aggiungi nuovo Appartamento</a>
      <table class="table">
         <thead>
            <tr>
               <th>Titolo</th>
               <th>Immagine</th>
               <th>Indirizzo</th>
               <th>Opzioni</th>

            </tr>
         </thead>
         <tbody>
            @foreach ($apartments as $apartment)
               <tr>
                  <td>{{ $apartment->title }}</td>
                  @if ($apartment->cover_img !== null)
                     <td><img src="{{ asset('storage/' . $apartment->cover_img) }}"
                           style="width: 80px; height: 50px; object-fit:cover; object-position: top  " alt="Card image cap">
                     </td>
                  @elseif(count($apartment->images))
                     <td><img src="{{ asset($apartment->images[0]->image) }}"
                           style="width: 80px; height: 50px; object-fit:cover; object-position: top  " alt="Card image cap">
                     </td>
                  @else
                     <td><img src="{{ asset('storage/apartments_images/placeholder-image.png') }}"
                           style="width: 80px; height: 50px; object-fit:cover; object-position: top  "
                           alt="Card image cap">
                     </td>
                  @endif
                  <td>{{ $apartment->address }}</td>

                  <td>
                     <div class="d-flex gap-lg-3 gap-md-2  gap-1 ">
                        <div>
                           <a href="{{ route('Admin.apartments.edit', $apartment->id) }}" class=" btn btn-success"><i class="fa-solid fa-pen"></i></a>
                        </div>
                        <div>
                           {{-- {{ route('Admin.apartments.show', $apartment->id) }} --}}
                           <a href="{{ route('Admin.apartments.show', $apartment->id) }}" class=" btn btn-warning"><i class="fa-solid fa-eye"></i></a>
                        </div>


                        <form class="delete-form " action="{{ route('Admin.apartments.destroy', $apartment->id) }}"
                           method="POST">
                           @csrf
                           @method('DELETE')
                           <button class="destroy-btn btn btn-danger text-dark"><i class="fa-regular fa-trash-can"></i></button>
                        </form>

                           <div>
                               <a href="{{route("subs.form", $apartment->id)}}" class=" ms-2  ms-lg-3  btn btn-info rounded-4 px-2 px-lg-4 "><i class="fa-brands fa-shopify"></i></a>
                           </div>

                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

