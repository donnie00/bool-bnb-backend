@extends('layouts.app')
@section('content')
   @dump($data)
    <div class="container my-5">
        <form action="#" method="post">
            @csrf
            @method('POST')
            {{-- <div class="row payment-row">

               
                @foreach([0, 1, 2] as $i)
             
                    <div class="col-12 col-md-4  card-container ">
                        <div class="spn-card rounded  bg-success text-center ">
                            <label class="d-block" for="{{'sub' . $i}}">
                                <h3>{{$data[$i]["name"]}}</h3>
                                <h6 class="">prezzo <strong> {{$data[$i]["price"]}} €</strong></h6>
                                <p class=""> durata  <strong> {{$data[$i]["duration"]}}h</strong></p>
                            </label>
                            <input id="{{'sub' . $i }}" class="" type="radio" name="amount" value="{{$data[$i]["price"]}}">
                        </div>
                    </div>
                @endforeach
            </div>
            <input type="hidden" name="project" value="">
            <div class="text-center final-button">
                <button type="submit" class="d-none btn btn-success" id="invia">Confirm Payment</button>
            </div> --}}
        </form>
        <div class="row">
            <div class="col-10 offset-1 col-md-6 offset-md-3">
                <div id="dropin-container"></div>
                <div class="text-center final-button">
                    <button id="submit-button" class="btn btn-secondary">Verify Payment Method</button>
                </div>
            </div>
        </div>
        @if (session('success_message'))
        <div class="alert alert-success">
            {{ session('success_message') }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <form method="post" id="payment-form" action="{{url('/checkout')}}">
            @csrf
            <div class="row payment-row">

               
               @foreach([0, 1, 2] as $i)
            
                   <div class="col-12 col-md-4  card-container ">
                       <div class="spn-card rounded  bg-success text-center ">
                           <label class="d-block" for="{{'sub' . $i}}">
                               <h3>{{$data[$i]["name"]}}</h3>
                               <h6 class="">prezzo <strong> {{$data[$i]["price"]}} €</strong></h6>
                               <p class=""> durata  <strong> {{$data[$i]["duration"]}}h</strong></p>
                           </label>
                           <input id="{{'sub' . $i }}" class="" type="radio" name="amount" value="{{$data[$i]["price"]}}">
                       </div>
                   </div>
               @endforeach
           </div>
           <input class="d-none" type="hidden" name="apartmentID" value="{{$apartmentID}}">
           <div class="text-center final-button">
               <button type="submit" class="d-none btn btn-success" id="invia">Confirm Payment</button>
           </div>
            <section>
                {{-- <label for="amount">
                    <span class="input-label">Amount</span>
                    <div class="input-wrapper amount-wrapper">
                        <input id="amount" name="amount" type="tel" min="1" placeholder="Amount"
                            value="10">
                    </div>
                </label> --}}

                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
            </section>

            <input class="" id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="button" type="submit"><span>Test Transaction</span></button>
        </form>
    </div>

    </div>
    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
        <script>
            var form = document.querySelector('#payment-form');
            var client_token = "{{ $token }}";
            braintree.dropin.create({
                authorization: client_token,
                selector: '#bt-dropin',
                // paypal: {
                //     flow: 'vault'
                // }
            }, function(createErr, instance) {
                if (createErr) {
                    console.log('Create Error', createErr);
                    return;
                }
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    instance.requestPaymentMethod(function(err, payload) {
                        if (err) {
                            console.log('Request Payment Method Error', err);
                            return;
                        }
                        // Add the nonce to the form and submit
                        document.querySelector('#nonce').value = payload.nonce;
                        form.submit();
                    });
                });
            });
        </script>
    {{-- <script src="{{ asset('js/admin/sponsor.js') }}" charset="utf-8"></script> --}}
@endsection


