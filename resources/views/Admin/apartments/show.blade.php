@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>APARTMENST: # {{ $apartment->id }}</h1>
        <div class="container">
            <!--Apartments Show -->

            <h1 class="mb-4">{{ $apartment->title }}</h1>
            <div v-if="$apartment->images" class="row d-flex">
                <div class="col-xl-6 col-lg-6 col-md-4 col-sm-12 col-6 mb-2 ">
                    <img class="img-fluid mb-2 card-img container-cards-left " :src="$apartment - > images[0].image"
                        alt="" />
                </div>
                <div class="col-6">
                    <div class="row d-flex">
                        <div v-for="(img, index) in $apartment->images" key="index"
                            v-bind:class="(index ===0) ? ' ' : 'col-xl-6 col-lg-6 col-md-5 col-sm-6 ' ">

                            <img v-if="index > 0"
                                :class="(index === 2) ? 'container-cards-top-right' : '' | (index === 4) ?
                                'container-cards-bottom-right' : ''"
                                class="img-fluid mb-2 card-img my-imgs " :src="img.image"
                                :alt="'image ' + (index + 1)" />
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="col-8 m-auto">

                <img class="img-fluid mb-2 card-img" :src="$apartment - > cover_img" alt="" />

            </div>
            <!-- <div class="col-6 container-cards">
                                      <img class="img-fluid container-cards-left mb-2 card-img  "
                                        :src="this.$apartment - > images[0].image"
                                        alt="" />
                                    </div>
                                    <div class="col-6">
                                      <div v-for="(img, i) in $apartment->images" class="row">
                                        <div  class="col-6 mb-2"><img class="img-fluid mb-2 card-img "
                                            :src="img.image"
                                            alt="" /></div>
                                      </div>
                                    </div> -->
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
                <span class="fw-semibold">Cosa troverai</span>
                @foreach ($apartment->services as $service)
                    <i>{{ $service->name }},</i>
                    <a href="ciao"></a>
                @endforeach
            </div>

            {{--      <router-link v-slot="{ ButtonDelete }" :to="{ name: 'Apartments.index' }">
                <ButtonDelete :is="ButtonDelete" @click="onDeleteClick()" />
            </router-link> --}}

            <a href="http://localhost:5173/apartments" class="btn btn-info ms-2 text-light">RETURN TO INDEX</a>

        </div>
    </div>
    <div class="container">
        <div class="card m-auto" style="width: 18rem;">
            <img class="card-img-top" src="{{ url('/images/img_app_test.jpg') }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $apartment->title }}</h5>
                <p class="card-text">{{ $apartment->description }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> <b>Rooms qty: </b>{{ $apartment->rooms_qty }} </li>
                <li class="list-group-item"> <b>Bathrooms qty: </b>{{ $apartment->bathrooms_qty }} </li>
                <li class="list-group-item"> <b>Beds qty: </b>{{ $apartment->beds_qty }} </li>
            </ul>
            <div class="card-body">

                <form action="{{ route('Admin.apartments.destroy', $apartment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger w-100">Delete</button>

                </form>
                <a href="{{ route('Admin.apartments.edit', $apartment->id) }}" class="btn btn-success">Edit</a>
            </div>
        </div>
    </div>
@endsection
