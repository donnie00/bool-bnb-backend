@extends('layouts.app')
@section('content')

    <div class="container my-5 py-5">
        <form action="#" method="post">
            @csrf
            @method('POST')
        </form>
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

            <form method="post" id="payment-form" action="{{ url('/checkout') }}">
                @csrf
                <div class="row payment-row">

                    <h1 class="text-uppercase text-center mt-5 mb-4">Scegli una Promozione:</h1>


                    @foreach ([0, 1, 2] as $i)
                        <div class="col-12 col-md-4  card-container ">
                            <?php
                            $class = '';
                            
                            switch ($i) {
                                case 0:
                                    $class = 'bg-silver';
                                    $icon='fa-regular fa-star ';
                                    break;
                                case 1:
                                    $class = 'bg-gold';
                                    $icon='fa-regular fa-sun';
                                    break;
                                case 2:
                                    $class = 'bg-diamond';
                                    $icon='fa-regular fa-gem';
                                    break;
                            }
                            ?>
                            <div style="cursor : pointer;"
                                class="subsCards spn-card rounded py-4 mt-2 text-center <?php echo $class; ?>">

{{-- input --}}
                                <input id="{{ 'sub' . $i }}" class="sub-plan-input opacity-0" type="radio" name="amount"
                                    value="{{ $data[$i]['price'] }}">


                                <label style="cursor: pointer" class="d-block sub-plan-label" for="{{ 'sub' . $i }}">
                                    <h3>{{ $data[$i]['name'] }}</h3>
                                    


                                    <i class="{{$icon}} mt-3 mb-5" style="transform:scale(300%)"></i>
                                    <h6 class="">prezzo <strong> {{ $data[$i]['price'] }} €</strong></h6>
                                    <p class=""> durata <strong> {{ $data[$i]['duration'] }}h</strong></p>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <input class="d-none" type="hidden" name="apartmentID" value="{{ $apartmentID }}">
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
                <div class="row  ">
                    <div class="col-7 text-end p-0">
                        <button class="hoverbtnPaga justify-item-end  button btn btn-secondary text-light  ms-5 px-5" type="submit"><span class="px-5">PAGA</span></button>
                    </div>
                    <div class="col text-end p-0">
                        <a type="button" href="{{route("Admin.apartments.show", $apartmentID)}}" class="hoverBtnBackToApartment btn btn-outline-primary opacity-50 me-3">
                            <i class="fa-solid fa-share"></i>
                            vai al tuo appartamento
                        </a>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";
        braintree.dropin.create({
            authorization: client_token,
            header: "paga con la carta",
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
