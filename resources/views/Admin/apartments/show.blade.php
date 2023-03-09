@extends('layouts.app')
@section('content')
   <section id="ds-Show-Apartment" class="px-xxl-5  mx-3 mx-sm-5 mx-lg-5">
      <div class=" container.fluid  px-md-3 px-xl-5">

         <!--Apartments Show -->

         <h1 class="mb-4">{{ $apartment->title }}</h1>

         <div class="img-container rounded-4 overflow-hidden">

            @if (count($apartment->images))
               <div class="img-row-left border-success border-5 row  row-cols-1  row-cols-lg-2 gap-2">

                  <!-- main img -->
                  <div class="col h-100 p-0 pb-md-2">
                     <img class="img-fluid w-100" src="{{ $apartment->images[0]->image }}" alt="" />
                  </div>

                  <!--  <div class="col h-100 p-0"> -->
                  <div class="row-dx col row row-cols-4 row-cols-lg-2 p-0">
                     @foreach ($apartment->images as $img)
                        @if ($loop->index > 0)
                           <div class="col h-50 p-0 px-md-1  px-lg-3 py-lg-4">
                              <img class="img-fluid" src="{{ $img->image }}"
                                 alt="{{ $apartment->title }}_img_{{ $loop->index + 1 }}" />
                           </div>
                        @endif
                     @endforeach
                  </div>
               </div>
            @endif

         </div>

         <div class="my-2">
            <i class="h5 me-2 fa-solid fa-map-location-dot"></i> {{ $apartment->address }}
         </div>
         <hr>
         <div class="d-flex mb-3">

            <div class="mb-2 mx-2">
               Rooms {{ $apartment->rooms_qty }} |
            </div>

            <div class="mb-2 mx-2">
               <i class="fa-solid fa-bed"></i> {{ $apartment->beds_qty }} |
            </div>

            <div class="mb-2 mx-2">
               <i class="fa-solid fa-bath"></i> {{ $apartment->bathrooms_qty }} |
            </div>

            <div class="mb-2 mx-2">
               MQ {{ $apartment->mq }} |
            </div>
            <div class="mx-2">
               <i class="fa-solid fa-euro-sign"></i> {{ $apartment->daily_price }} night
            </div>

         </div>
         <hr>
         <div class="mb-2 mx-2">
            <p>{{ $apartment->description }}</p>
         </div>
         <hr>

         <div class="mb-2 mx-2 col-8">
            <span class="fw-semibold">Cosa troverai: </span>

            @foreach ($apartment->services as $service)
               <img class="icons-services ms-1 " src="{{ asset('services-icons/' . $service->icon) }}" alt="">
               <i class=" me-3">{{ $service->name }}</i>
            @endforeach
         </div>

         <a href="http://localhost:5173/apartments" class="btn btn-info ms-2 text-light">RETURN TO INDEX</a>

      </div>
   </section>
@endsection
