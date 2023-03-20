@extends('layouts.app')
@section('content')
    @vite(['resources/js/deleteForm.js'])
    @vite(['resources/js/getSponsorizedTime.js'])
    <section id="ds-Show-Apartment" class="px-xxl-5  mx-3 mx-sm-5 mx-lg-5">
        <div class=" container-fluid  px-md-3 px-xl-5">
            <!--Apartments Show -->
            <h1 class="mb-4 d-inline">{{ $apartment->title }}</h1>
            <div class="my-3">
                @if ($apartment->visible)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="width:35px">
                        <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                    </svg>
                    <span class="fw-bold">Questo appartamento è visibile publicamente</span>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" style="width:35px">
                        <!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z" />
                    </svg>
                    <span class="fw-bold">Questo appartamento è nascosto al pubblico</span>
                @endif
            </div>

            <div class="py-4 img-container w-75 m-auto rounded-4 overflow-hidden">
                <div class="col-8 m-auto">
                    @if ($apartment->cover_img && $apartment->images)
                        <div class="row">
                            <div class="col">
                                <img class="img-fluid w-100 rounded-4 pb-2"
                                    src="{{ asset('storage/' . $apartment->cover_img) }}" alt="" />
                            </div>
                        </div>
                        <div class="row g-1">
                            @foreach ($apartment->images as $img)
                                <div class="col m-auto">
                                    <img src="{{ asset('storage/' . $img->image) }}" alt=""
                                        class="img-fluid h-100 rounded-3" style="object-fit:cover">
                                </div>
                            @endforeach
                        @elseif ($apartment->cover_img)
                            <div class="row">
                                <div class="col">
                                    <img class="img-fluid w-100 rounded-4 pb-2"
                                        src="{{ asset('storage/' . $apartment->cover_img) }}" alt="" />
                                </div>
                                <div class="row g-1">
                                    @foreach ($apartment->images as $img)
                                        <div class="col">
                                            <img src="{{ $img->image }}" alt="" class="img-fluid h-100 rounded-3"
                                                style="object-fit:cover">
                                        </div>
                                    @endforeach
                                @elseif (count($apartment->images))
                                    <div class="row">
                                        <div class="col">
                                            <img class="img-fluid w-100 rounded-4 pb-2"
                                                src="{{ $apartment->images[0]->image }}" alt="" />
                                        </div>
                                    </div>
                                    <div class="row g-1">
                                        @foreach ($apartment->images as $img)
                                            <div class="col m-auto ">
                                                <img src="{{ $img->image }}" alt=""
                                                    class="img-fluid h-100 rounded-3" style="object-fit:cover">
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="row">
                                            <div class="col">
                                                <img class="img-fluid mx-auto d-block"
                                                    src="{{ asset('storage/placeholder-image.png') }}" alt="" />
                                            </div>
                                        </div>
                    @endif
                </div>
            </div>
        </div>


        <div class="w-75 m-auto">
            <h2 class="my-3">{{ ucfirst($apartment->address) }}</h2>
            <hr>

            <div class="row  gap-1 gap-md-3 mb-3 text-center">

                <div class="col  py-1 rounded-3 bg-primary">
                    Camere: {{ $apartment->rooms_qty }}
                </div>

                <div class="col  py-1 rounded-3 bg-primary"> Letti: {{ $apartment->beds_qty }}
                </div>

                <div class=" col  py-1 rounded-3 bg-primary"> Bagni: {{ $apartment->bathrooms_qty }}
                </div>

                <div class="col  py-1 rounded-3 bg-primary">
                    MQ: {{ $apartment->mq }}
                </div>
                <div class="col  py-1 rounded-3 bg-primary"> &euro;/Notte {{ $apartment->daily_price }}
                </div>

            </div>
            <hr>
            <div class="mb-2 mx-2">
                <p class="fs-6">{{ ucfirst($apartment->description) }}</p>
            </div>
            <hr>

            <div class="mb-4 mx-2 w-75 m-auto">
                <p class="fw-semibold">Cosa troverai: </p>
                <ul class="row g-3">
                    @foreach ($apartment->services as $service)
                        <li class="col-12 col-md-6">
                            <img width="25px" class="icons-services "
                                src="{{ asset('services-icons/' . $service->icon) }}" alt="">
                            <i class=" me-3">{{ $service->name }}</i>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
        <div class="w-75 m-auto">
        <div class="row">
            <div class="col-12  col-md-6 ">
                <div id="sub-infos-container" class=" mb-3  text-center  rounded-2">

                    <div id="subscription-bg-container" class="border border-3  pt-3 pb-2">


                        <h5 class="fs-5 subscription-true text-uppercase">Promo Attiva!</h5>
                        <h1 class="text-uppercase " id="subscription-title"></h1>
                        {{-- {{ $sub->name }} --}}
                        <p class="fs-4 subscription-true">scade il:
                        <p class="text-uppercase fw-bold p-0" id="expiration-date"></p>
                        </p>

                    </div>
                </div>
            </div>
            {{-- @else --}}

            <div class="col-12  col-md-6 py-3 bg-info rounded-3">
                <a href="{{ route('subs.form', $apartment->id) }}" class="text-decoration-none link-dark text-center">
                    <h4 id="bunner-sponsor-title" class="fs5 text-warning">Sponsorizza il tuo appartamento!</h4>
                    <p class="fs-6 text-center p-1">Avere un appartamento sponsorizzato permette di aumentarne la
                        visibilità
                        posizionandolo sempre in cima ai risultati di ricerca!
                    </p>
                    <p>Scopri di più</p>
                </a>
            </div>
        </div>
      </div>
        {{-- @endif --}}

        


        <div class="row w-75 m-auto mt-3 g-2 py-2 mb-3 justify-content-md-around">

            <a href="{{ route('Admin.apartments.index') }}" class="col-12 col-md-3 btn btn-info text-light">Torna agli
                Appartamenti</a>

            <a href="{{ route('Admin.apartments.edit', $apartment->id) }}" class="col-12 col-md-3 btn btn-warning">Modifica
                Appartamento</a>
            <form class="delete-form col-12 col-md-3" action="{{ route('Admin.apartments.destroy', $apartment->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger w-100 ">Elimina Appartamento</button>
            </form>
        </div>
        @if (count($apartment->messages))
            <div class="row col-12 col-md-10 col-lg-8 m-auto mb-3">
                <div class="col">
                    <h2>Messaggi ricevuti:</h2>
                    <div class="card ps-1 rounded-3">
                        <ul>
                            @foreach ($apartment->messages as $message)
                                @if ($loop->index < 3)
                                    <li class="p-2">
                                        <span class="fw-bold fs-6 d-block">{{ $message['subject'] }}</span>
                                        <span class="fw-semibold">{{ $message['sender'] }}</span>
                                        <span class="text-justify">{{ '(' . $message['email'] . ')' }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <a href="{{ route('Admin.dashboard.messages') }}" class="btn btn-primary my-3 d-block">
                        Guarda tutti i messaggi
                    </a>
                </div>
            </div>
        @endif
        </div>
    </section>

    </script>
@endsection
