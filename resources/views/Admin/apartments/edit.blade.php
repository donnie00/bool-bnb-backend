@extends('layouts.form')
@section('content')
   <div class="container">
      <h1 class="text-uppercase">EDIT APARTMENT: # {{ $apartment->id }}</h1>


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

      <form action="{{ route('Admin.apartments.update', $apartment->id) }}" method="POST" enctype="multipart/form-data"
         class="row">
         @csrf
         @method('PUT')

         {{-- title --------------------------------------------------------------- --}}
         <div class="input-container pb-2 col-12 ">
            <label class="form-label fw-semibold " for="title">Title:
               <span class="text-danger ps-1">*</span>
            </label>
            <input type="text"
               class="form-control
              @error('title') is-invalid @elseif(old('title')) is-valid  @enderror"
               name="title" id="title" value="{{ old('title', $apartment->title) }}">

            @error('title')
               <div class="invalid-feedback"> {{ $message }} </div>
            @elseif(old('title'))
               <div class="valid-feedback"> ok </div>
            @enderror
         </div>



         {{-- price/night --------------------------------------------------------------- --}}
         <div class="input-container pb-2 col-12 col-md-5">
            <label for="daily_price" class="form-label fw-semibold">price/night:
               <span class="text-danger ps-1">*</span>
            </label>
            <input type="number"
               class="form-control
              @error('daily_price') is-invalid @elseif(old('daily_price')) is-valid @enderror"
               name="daily_price" id="daily-price" value="{{ old('daily_price', $apartment->daily_price) }}">

            @error('daily_price')
               <div class="invalid-feedback"> {{ $message }} </div>
            @elseif(old('daily_price'))
               <div class="valid-feedback"> ok </div>
            @enderror
         </div>

         {{-- MQ --------------------------------------------------------------- --}}
         <div class="input-container pb-2 col-12 col-md-5">
            <label for="mq" class="form-label fw-semibold">MQ:</label>
            <input type="number"
               class="form-control
              @error('mq') is-invalid @elseif(old('mq')) is-valid @enderror"
               name="mq" id="mq" value="{{ old('mq', $apartment->mq) }}">

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
                     {{ old('visible', $apartment->visible) === 1 ? 'checked' : '' }}>
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
            <label class="form-label fw-semibold text-uppercase" for="cover_img">IMMAGINE</label>
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
            <label class="form-label fw-semibold" for="description">Descrizione</label>
            <textarea name="description" id="description" cols="30" rows="3"
               class="form-control
                @error('description') is-invalid @elseif(old('description')) is-valid @enderror">
                {{ old('description', $apartment->description) }}</textarea>

            @error('description')
               <div class="invalid-feedback">{{ $message }}</div>
            @elseif(old('description'))
               <div class="valid-feedback">ok</div>
            @enderror
         </div>

         {{-- ROOMS QTY ------------------------------------------------------------------ --}}

         <div class="input-container pb-2 col-4 ">
            <label class="form-label fw-semibold" for="rooms_qty">rooms quantity
               <span class="text-danger ps-1">*</span>
            </label>
            <select
               class="form-control
            @error('rooms_qty') is-invalid @elseif(old('rooms_qty')) is-valid @enderror"
               id="rooms_qty" name="rooms_qty">

               @for ($i = 1; $i <= 5; $i++)
                  <option value="{{ $i }}"
                     {{ old('rooms_qty', $apartment->rooms_qty === $i) ? 'selected' : '' }}>
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
            <label class="form-label fw-semibold" for="beds_qty">bed quantity
               <span class="text-danger ps-1">*</span>
            </label>
            <select
               class="form-control
            @error('beds_qty') is-invalid @elseif(old('beds_qty')) is-valid @enderror"
               id="beds_qty" name="beds_qty">
               @for ($i = 1; $i <= 5; $i++)
                  <option value="{{ $i }}"
                     {{ old('beds_qty', $apartment->beds_qty === $i) ? 'selected' : '' }}>
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
            <label class="form-label fw-semibold" for="bathrooms_qty">bed quantity
               <span class="text-danger ps-1">*</span>
            </label>
            <select
               class="form-control
            @error('bathrooms_qty') is-invalid @elseif(old('bathrooms_qty')) is-valid @enderror"
               id="bathrooms_qty" name="bathrooms_qty">

               @for ($i = 1; $i <= 5; $i++)
                  <option
                     value="{{ $i }}"{{ old('bathrooms_qty', $apartment->bathrooms_qty === $i) ? 'selected' : '' }}>

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
            <label class="form-label fw-semibold d-block">SERVICES:
               <span class="text-danger ps-1">*</span>
            </label>
            <div class="row">
               @foreach ($services as $service)
                  <div class="col d-flex align-items-center @error('services') is-invalid @enderror ">
                     <input class="form-check @error('services') is-invalid @enderror" type="checkbox"
                        value="{{ $service->id }}" id="service_{{ $loop->index }}" name="services[]"
                        {{ $apartment->services->contains('id', $service->id) ? 'checked' : '' }}>
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

         <h6 class="">address saved: {{ $apartment->address }}</h6>
         <legend>MODIFY ADDRESS: </legend>

         <div class="input-container pb-2 col-12 ">
            <label class="form-label fw-semibold " for="address">address:
               <span class="text-danger ps-1">*</span>
            </label>
            <input type="text"
               class="form-control
              @error('address') is-invalid @elseif(old('address')) is-valid  @enderror"
               name="address" id="address" value="{{ old('address', $apartment->address) }}">

            @error('address')
               <div class="invalid-feedback"> {{ $message }} </div>
            @elseif(old('address'))
               <div class="valid-feedback"> ok </div>
            @enderror
         </div>

         {{-- opzioni --}}
         <div class="p-3 text-end">
            <a href="{{ route('Admin.apartments.index') }}" class="btn btn-info text-light"> Back </a>
            <button class="btn btn-primary text-light">Update apartament</button>
         </div>
         </fieldset>

         {{-- opzioni --}}
         <div class="p-3">
            <a href="{{ route('Admin.apartments.show', $apartment->id) }}" class="btn btn-primary">Annulla</a>
            <button class="btn btn-secondary">update</button>
      </form>
   </div>


   <!-- Javascript Requirements -->
   <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

   <!-- Laravel Javascript Validation -->
   <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

   {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateApartmentRequest') !!};
   <style>
      span {
         color: red
      }
   </style>
@endsection
