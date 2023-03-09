@extends('layouts.form')

@section('content')
   <div class="container">
      <h1 class="text-uppercase">create New Apartment:</h1>


      {{-- rintraccia qualsiasi errore --}}
      @if ($errors->any())
         <div class="alert alert-danger">
            I dati inseriti non sono validi:
            {{-- lista errori da fixare --}}
            <ul>
               @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
      @endif

      <form action="{{ route('Admin.apartments.store') }}" method="POST" enctype="multipart/form-data" class="row">
         @csrf()

         {{-- title --------------------------------------------------------------- --}}
         <div class="input-container pb-2 col-12 ">
            <label class="form-label text-uppercase" for="title">TITOLO:</label>
            <input type="text"
               class="form-control
                    @error('title') is-invalid @elseif(old('title')) is-valid @enderror"
               name="title" id="title" value="{{ $errors->has('title') ? '' : old('title') }}">

            @error('title')
               <div class="invalid-feedback"> {{ $message }} </div>
            @elseif(old('title'))
               <div class="valid-feedback"> ok </div>
            @enderror
         </div>



         {{-- price/night --------------------------------------------------------------- --}}
         <div class="input-container pb-2 col-12 col-md-5">
            <label for="daily_price" class="form-label text-uppercase">price/night:</label>
            <input type="number" step="0.01"
               class="form-control
                    @error('daily_price') is-invalid @elseif(old('daily_price')) is-valid @enderror"
               name="daily_price" id="daily-price" value="{{ $errors->has('daily_price') ? '' : old('daily_price') }}">

            @error('daily_price')
               <div class="invalid-feedback"> {{ $message }} </div>
            @elseif(old('daily_price'))
               <div class="valid-feedback"> ok </div>
            @enderror
         </div>

         {{-- MQ --------------------------------------------------------------- --}}
         <div class="input-container pb-2 col-12 col-md-5">
            <label for="mq" class="form-label text-uppercase">MQ:</label>
            <input type="number"
               class="form-control
                    @error('mq') is-invalid @elseif(old('mq')) is-valid @enderror"
               name="mq" id="mq" value="{{ $errors->has('mq') ? '' : old('mq') }}">

            @error('mq')
               <div class="invalid-feedback"> {{ $message }} </div>
            @elseif(old('mq'))
               <div class="valid-feedback"> ok </div>
            @enderror
         </div>

         {{-- visible ------------------------------------------------------------ --}}
         <div class="input-container pb-2 col-12  col-sm-4 col-md-2 ps-3 d-flex align-items-center justify-content-center">
            <div class="form-check form-switch p-0 text-uppercase">
               <label class="form-check-label" for="visible">visible</label>

               <div class="form-check form-switch pt-2">
                  {{-- 2 imput per raccogliere true o false subito --}}
                  <input type="hidden" name="visible" id="visible" value="0">

                  <input
                     class="form-check-input
                            @error('visible') is-invalid @elseif(old('visible')) is-valid @enderror "
                     value="1" type="checkbox" role="switch" id="visible" name="visible"
                     {{ old('visible', 1) ? 'checked' : '' }}>
               </div>
            </div>
            @error('visible')
               <div class="invalid-feedback"> {{ $message }} </div>
            @elseif(old('visible'))
               <div class="valid-feedback"> ok </div>
            @enderror
         </div>


         {{-- cover_img ----------------------------------------------------------- --}}
         <div class="input-container pb-2">
            <label class="form-label text-uppercase" for="cover_img">IMMAGINE</label>
            <input type="file" class="form-control
                      @error('cover_img') is-invalid  @enderror"
               name="cover_img" id="cover_img" value="{{ old('cover_img') }}">


            @error('cover_img')
               <div class="invalid-feedback">{{ $message }} </div>
            @enderror
         </div>

         <button class="input-container pb-2 mt-2">PLACEOLDER add image (max 4)</button>

         {{-- description -------------------------------------------------- --}}
         <div class="input-container pb-2">
            <label class="form-label" for="description">Descrizione</label>
            <textarea name="description" id="description" cols="30" rows="3"
               class="form-control
                      @error('description') is-invalid @elseif(old('description')) is-valid @enderror">
                      {{ old('description') }}</textarea>

            @error('description')
               <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('description'))
               <div class="valid-feedback">ok</div>
            @enderror
         </div>

         {{-- ROOMS QTY ------------------------------------------------------------------ --}}

         <div class="input-container pb-2 col-4 ">
            <label class="form-label" for="rooms_qty">rooms quantity</label>
            <select
               class="form-control
                  @error('rooms_qty') is-invalid @elseif(old('rooms_qty')) is-valid @enderror"
               id="rooms_qty" name="rooms_qty">

               @for ($i = 1; $i <= 5; $i++)
                  <option value="{{ $i }}" {{ old('rooms_qty') ? 'selected' : '' }}>
                     {{ $i == 5 ? $i . ' +' : $i }}
                  </option>
               @endfor

               @error('rooms_qty')
                  <div class="invalid-feedback"> {{ $message }} </div>
               @elseif(old('rooms_qty'))
                  <div class="valid-feedback"> ok </div>
               @enderror
            </select>
         </div>

         {{-- BEDROOMS QTY ------------------------------------------------------------------ --}}

         <div class="input-container pb-2 col-4 ">
            <label class="form-label" for="beds_qty">bed quantity</label>
            <select
               class="form-control
                  @error('beds_qty') is-invalid @elseif(old('beds_qty')) is-valid @enderror"
               id="beds_qty" name="beds_qty">
               @for ($i = 1; $i <= 5; $i++)
                  <option value="{{ $i }}" {{ old('beds_qty') ? 'selected' : '' }}>
                     {{ $i == 5 ? $i . ' +' : $i }}

                  </option>
               @endfor

               @error('beds_qty')
                  <div class="invalid-feedback"> {{ $message }} </div>
               @elseif(old('beds_qty'))
                  <div class="valid-feedback"> ok </div>
               @enderror
            </select>
         </div>


         {{-- BATHROOMS QTY ------------------------------------------------------------------ --}}

         <div class="input-container pb-2 col-4 ">
            <label class="form-label" for="bathrooms_qty">bed quantity</label>
            <select
               class="form-control
                  @error('bathrooms_qty') is-invalid @elseif(old('bathrooms_qty')) is-valid @enderror"
               id="bathrooms_qty" name="bathrooms_qty">

               @for ($i = 1; $i <= 5; $i++)
                  <option value="{{ $i }}" {{ old('bathrooms_qty') ? 'selected' : '' }}>

                     {{ $i == 5 ? $i . ' +' : $i }}

                  </option>
               @endfor

               @error('bathrooms_qty')
                  <div class="invalid-feedback"> {{ $message }} </div>
               @elseif(old('bathrooms_qty'))
                  <div class="valid-feedback"> ok </div>
               @enderror
            </select>
         </div>


         {{-- services ------------------------------------------------------------------ --}}

         <div class="input-container pb-2">
            <label class="form-label d-block">SERVICES:</label>
            <div class="row">
               @foreach ($services as $service)
                  <div class="col d-flex align-items-center @error('services') is-invalid @enderror ">
                     <input class="form-check @error('services') is-invalid @enderror" type="checkbox"
                        value="{{ $service->id }}" id="service_{{ $loop->index }}" name="services[]"
                        {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                     {{-- ICONE che si coloran con over --++++++++++++++++++++++++++++++++++++++++++++++++++++ ++ + + --}}
                     <label
                        for="service_{{ $loop->index }}">{{ $service->name == 'Aria Condizionata' ? 'Clima' : $service->name }}</label>
                  </div>
               @endforeach

               @error('services')
                  <div class="invalid-feedback">
                     {{ $message }}
                  </div>
               @enderror

            </div>
         </div>

         <legend>ADDRESS: </legend>
         <fieldset class="border rounded-3 p-3 row">

            {{-- street name --------------------------------------------------------------- --}}
            <div class="input-container pb-2 col-12 col-md-5">
               <label class="form-label" for="streetName">Street Name:</label>
               <input type="text"
                  class="form-control
                  @error('streetName') is-invalid @elseif(old('	streetName')) is-valid @enderror"
                  name="streetName" id="streetName" value="{{ $errors->has('streetName') ? '' : old('streetName') }}">

               @error('streetName')
                  <div class="invalid-feedback"> {{ $message }} </div>
               @elseif(old('streetName'))
                  <div class="valid-feedback"> ok </div>
               @enderror
            </div>

            {{-- street number --------------------------------------------------------------- --}}
            <div class="input-container pb-2 col-12 col-md-4">
               <label for="streetNumber" class="form-label">Street Number:</label>
               <input type="text"
                  class="form-control
                  @error('streetNumber') is-invalid @elseif(old('	streetNumber')) is-valid @enderror"
                  name="streetNumber" id="streetNumber"
                  value="{{ $errors->has('streetNumber') ? '' : old('streetNumber') }}">

               @error('streetNumber')
                  <div class="invalid-feedback"> {{ $message }} </div>
               @elseif(old('streetNumber'))
                  <div class="valid-feedback"> ok </div>
               @enderror
            </div>

            {{-- postal code --------------------------------------------------------------- --}}
            <div class="input-container pb-2 col-12 col-md-3">
               <label for="postalCode" class="form-label">Postal Code:</label>
               <input type="number"
                  class="form-control
                  @error('postalCode') is-invalid @elseif(old('	postalCode')) is-valid @enderror"
                  name="postalCode" id="postalCode" value="{{ $errors->has('postalCode') ? '' : old('postalCode') }}">

               @error('postalCode')
                  <div class="invalid-feedback"> {{ $message }} </div>
               @elseif(old('postalCode'))
                  <div class="valid-feedback"> ok </div>
               @enderror
            </div>

            {{-- city--------------------------------------------------------------- --}}
            <div class="input-container pb-2 col-12 col-md-5">
               <label for="municipality" class="form-label">City/TOWN:</label>
               <input type="text"
                  class="form-control
                  @error('municipality') is-invalid @elseif(old('	municipality')) is-valid @enderror"
                  name="municipality" id="municipality"
                  value="{{ $errors->has('municipality') ? '' : old('municipality') }}">

               @error('municipality')
                  <div class="invalid-feedback"> {{ $message }} </div>
               @elseif(old('municipality'))
                  <div class="valid-feedback"> ok </div>
               @enderror
            </div>

            {{-- countryCode --}}
            <div class="input-container pb-2 col-12 col-md-2">
               <label class="form-label" for="countryCode">COUNTRY CODE:</label>
               <select
                  class="form-control
        @error('countryCode') is-invalid @elseif(old('countryCode')) is-valid @enderror"
                  id="countryCode" name="countryCode">

                  <option value="IT" selected {{ old('countryCode') ? 'selected' : '' }} --}}>IT </option>

               </select>
               @error('countryCode')
                  <div class="invalid-feedback">{{ $message }}</div>
               @elseif(old('countryCode'))
                  <div class="valid-feedback">ok </div>
               @enderror
            </div>
         </fieldset>

         {{-- opzioni --}}
         <div class="p-3 text-end">
            <a href="{{ route('Admin.apartments.index') }}" class="btn btn-info text-light">Annulla</a>
            <button class="btn btn-primary text-light">Aggiungi appartamento</button>
      </form>
   </div>

@endsection
