@extends('layouts.dashboard')

@section('content')


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @media (max-width: 949px) {
            .junior {
                display: none;
            }

        }

        @media (min-width: 950px) {
            .small {
                display: none;
            }

        }
    </style>


    <div class="container">
        <div class="small">
            <a href="#top" class="position-fixed bottom-0 btn btn-info text-white  rounded-4 px-3 py-2 fs-4 text-center"
                style="margin-left: -3rem ;margin-right: 2rem; margin-bottom: 1rem;">
                <i class="fa-solid fa-up-long"></i>
            </a>

            <div>
                @if (count($new_messages))
                    <div class="d-flex justify-between align-items-center">
                           <div>
                            <div class="fs-4">Messaggi</div>
                           </div>
                    </div>



                    @foreach ($new_messages as $apartment => $message)
                    <div class="row py-3 my-3 bg-dark rounded-1">
                        <div class="col-12" >
                           <h4 class="fs-6 text-center text-white">{{ $apartment }}</h4>
                        </div>

                        @foreach ($message as $key => $singleMessage)
                                    @php
                                        $varId = rand() . '_' . $key;
                                    @endphp
                        <div class="col-12">         
                           <span class="text-primary fs-6">{{ $singleMessage['sender'] }}</span>
                           <br>
                           <span class="text-light">{{ $singleMessage['email'] }}</span>
                        </div>
                        
                        <div class="col-12">
                           
                           <a class="fs-6" data-bs-toggle="collapse"
                               href="#collapseMessage{{ $varId }}" role="button"
                               aria-expanded="false" aria-controls="collapseExample">

                               <span>{{ $singleMessage['subject'] }}</span>
                           </a>
                           <div class="collapse" id="collapseMessage{{ $varId }}">
                               <div class="text-center text-white py-1">
                                   {{ $singleMessage['message'] }}
                               </div>
                           </div>
                           <hr class="text-white">


                        </div>

                        <div class="col-12 mb-2">
                           <div class="d-flex flex-column gap-2 flex-shrink-0">
                              <a href="mailto:{{ $singleMessage['email'] }}"
                                  class="btn btn-light w-auto">
                                  Rispondi via mail
                                  {{-- <i class="fa-solid fa-envelope-open fs-2 mx-3"></i> --}}
                              </a>
                              <a href="{{ route('messages.read', $singleMessage['id']) }}"
                                  class=" btn btn-primary w-auto">
                                  Segna come letto
                              </a>
                          </div>
                        </div>
                                   <hr class="text-white">        
                                @endforeach
                          </div>   
                    @endforeach




                @else
                    <h3 class="fs-3 text-center my-5">Non ci sono nuovi messaggi da mostrare!</h3>
                @endif

            </div>


            @if (count($read_messages))
             <div class="d-flex align-items-center">
               <div class="fs-4">Messaggi letti</div>
               <div class="dropdown mx-3">
                   <button class="btn btn-primary dropdown-toggle fs-6" type="button"
                       data-bs-toggle="dropdown"aria-expanded="false">
                       Menù
                   </button>
                   <ul class="dropdown-menu overflow-auto">
                    @foreach ($read_messages as $apartment => $value)
                    <li class="dropdown-item d-flex align-items-center justify-content-between">
                        <a href="{{ '#' . $apartment . '_old' }}" class="link-dark text-decoration-none mx-3">
                            {{ $apartment }}
                        </a>
                        <span class="badge bg-info">{{ count($value) }}</span>
                    </li>
                @endforeach
                   </ul>
               </div>
             </div>



                  @foreach ($read_messages as $apartment => $message)
                    <div class="row py-3 my-3 bg-dark rounded-1">
                        <div class="col-12" id="{{ $apartment }}">
                           <h4 class="fs-6 text-center text-white">{{ $apartment }}</h4>
                        </div>

                        @foreach ($message as $key => $singleMessage)
                                    @php
                                        $varId = rand() . '_' . $key;
                                    @endphp
                        <div class="col-12">         
                           <span class="text-primary fs-6">{{ $singleMessage['sender'] }}</span>
                           <br>
                           <span class="text-light">{{ $singleMessage['email'] }}</span>
                        </div>
                        
                        <div class="col-12">
                           
                           <a class="fs-6" data-bs-toggle="collapse"
                               href="#collapseMessage{{ $varId }}" role="button"
                               aria-expanded="false" aria-controls="collapseExample">

                               <span>{{ $singleMessage['subject'] }}</span>
                           </a>
                           <div class="collapse" id="collapseMessage{{ $varId }}">
                               <div class="text-center text-white py-1">
                                   {{ $singleMessage['message'] }}
                               </div>
                           </div>
                           <hr class="text-white">


                        </div>

                        <div class="col-12 mb-2">
                           <div class="d-flex flex-column gap-2 flex-shrink-0">
                              <a href="mailto:{{ $singleMessage['email'] }}"
                                  class="btn btn-light w-auto">
                                  Rispondi via mail
                                  {{-- <i class="fa-solid fa-envelope-open fs-2 mx-3"></i> --}}
                              </a>
                              <a href="{{ route('messages.read', $singleMessage['id']) }}"
                                  class=" btn btn-primary w-auto">
                                  Segna come letto
                              </a>
                          </div>
                        </div>
                                         
                                @endforeach
                          </div>   
                    @endforeach

         @endif
         <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
         
           
        </div>
    </div>
    
        <div class="junior">
         <a href="#top" class="position-fixed bottom-0 btn btn-info text-white  rounded-4 px-3 py-2 fs-4 text-center"
             style="margin-left:100px; margin-right: 2rem; margin-bottom: 1rem;">
             <i class="fa-solid fa-up-long"></i>
         </a>
         @if (count($new_messages))
             <div class="container">
                 <div class="d-flex align-items-center">
                     <h2 class="fs-2 text-center">Nuovi messaggi: </h2>

                     <div class="dropdown mx-3">
                         <button class="btn btn-primary dropdown-toggle fs-6" type="button" data-bs-toggle="dropdown"
                             aria-expanded="false">
                             Menù
                         </button>
                         <ul class="dropdown-menu">
                             @foreach ($new_messages as $apartment => $value)
                                 <li class="dropdown-item fs-5 d-flex align-items-center justify-content-between">
                                     <a href="{{ '#' . $apartment }}" class="link-dark text-decoration-none mx-3">
                                         {{ $apartment }}
                                     </a>
                                     <span class="badge bg-info">{{ count($value) }}</span>
                                 </li>
                             @endforeach
                         </ul>
                     </div>


                     <a href="#readMessages" class="ms-auto">
                         <h3 class="fs4">
                             Vai ai messaggi già letti
                         </h3>
                     </a>
                 </div>

                 @foreach ($new_messages as $apartment => $message)
                     <table class="table table-dark align-middle my-4 w-100" id="{{ $apartment }}">
                         <thead>
                             <tr>
                                 <th colspan="99" class="table-primary display-6 text-center">{{ $apartment }}</th>
                             </tr>
                         </thead>

                         <tbody>
                             @foreach ($message as $key => $singleMessage)
                                 @php
                                     $varId = rand() . '_' . $key;
                                 @endphp
                                 <tr>
                                     <td>
                                         <span class="text-primary fs-4">{{ $singleMessage['sender'] }}</span>
                                         <br>
                                         <span class="text-light">{{ $singleMessage['email'] }}</span>
                                     </td>
                                     <td class="text-center w-50">
                                         <a class="fs-4" data-bs-toggle="collapse"
                                             href="#collapseMessage{{ $varId }}" role="button"
                                             aria-expanded="false" aria-controls="collapseExample">

                                             <span>{{ $singleMessage['subject'] }}</span>
                                         </a>
                                         <div class="collapse" id="collapseMessage{{ $varId }}">
                                             <div class="text-center fs-5  py-2">
                                                 {{ $singleMessage['message'] }}
                                             </div>
                                         </div>
                                     </td>
                                    
                                     <td class="">
                                         <div class="d-flex align-items-center justify-content-end gap-3">
                                             <div class="text-end">
                                                 <span class="text-muted">
                                                     {{ date('d/m/Y', strtotime($singleMessage['created_at'])) }}
                                                 </span>
                                                 <br>
                                                 <span>
                                                     {{ date('H:i', strtotime($singleMessage['created_at'])) }}
                                                 </span>
                                             </div>
                                             <div class="d-flex flex-column flex-shrink-0">
                                                 <a href="mailto:{{ $singleMessage['email'] }}"
                                                     class="btn btn-light w-auto">
                                                     Rispondi via mail
                                                     {{-- <i class="fa-solid fa-envelope-open fs-2 mx-3"></i> --}}
                                                 </a>
                                                 <a href="{{ route('messages.read', $singleMessage['id']) }}"
                                                     class=" btn btn-primary w-auto">
                                                     Segna come letto
                                                 </a>
                                             </div>
                                         </div>
                                     </td>
                                 </tr>
                             @endforeach
                         </tbody>
                     </table>
                 @endforeach

             </div>
         @else
             <h1 class="text-center my-5">Non ci sono nuovi messaggi da mostrare!</h1>
         @endif


         @if (count($read_messages))
         <div class="container">
             <div class="d-flex align-items-center">
                 <h2 class="text-center" id="readMessages">Messaggi già letti:</h2>

                 <div class="dropdown mx-3">
                     <button class="btn btn-primary dropdown-toggle fs-5" type="button" data-bs-toggle="dropdown"
                         aria-expanded="false">
                         Menù
                     </button>
                     <ul class="dropdown-menu">
                         @foreach ($read_messages as $apartment => $value)
                             <li class="dropdown-item fs-5 d-flex align-items-center justify-content-between">
                                 <a href="{{ '#' . $apartment . '_old' }}" class="link-dark text-decoration-none mx-3">
                                     {{ $apartment }}
                                 </a>
                                 <span class="badge bg-info">{{ count($value) }}</span>
                             </li>
                         @endforeach
                     </ul>
                 </div>
             </div>
             @foreach ($read_messages as $apartment => $message)
                 <table class="table table-dark align-middle my-4 w-100" id="{{ $apartment }}">
                     <thead>
                         <tr>
                             <th colspan="99" class="table-primary display-6 text-center">{{ $apartment }}</th>
                         </tr>
                     </thead>

                     <tbody>
                         @foreach ($message as $key => $singleMessage)
                             @php
                                 $varId = rand() . '_' . $key;
                             @endphp
                             <tr>
                                 <td>
                                     <span class="text-primary fs-4">{{ $singleMessage['sender'] }}</span>
                                     <br>
                                     <span class="text-light">{{ $singleMessage['email'] }}</span>
                                 </td>
                                 <td class="text-center w-50">
                                     <a class="fs-4" data-bs-toggle="collapse"
                                         href="#collapseMessage{{ $varId }}" role="button" aria-expanded="false"
                                         aria-controls="collapseExample">

                                         <span>{{ $singleMessage['subject'] }}</span>
                                     </a>
                                     <div class="collapse" id="collapseMessage{{ $varId }}">
                                         <div class="text-center py-2">
                                             {{ $singleMessage['message'] }}
                                         </div>
                                     </div>
                                 </td>                              
                                 <td>
                                     <div class="d-flex align-items-center justify-content-end gap-3">
                                         <div class="text-end">
                                             <span class="text-muted">
                                                 {{ date('d/m/Y', strtotime($singleMessage['created_at'])) }}
                                             </span>
                                             <br>
                                             <span>
                                                 {{ date('H:i', strtotime($singleMessage['created_at'])) }}
                                             </span>
                                         </div>
                                         <div class="d-flex flex-column flex-shrink-0">
                                             <a href="mailto:{{ $singleMessage['email'] }}"
                                                 class="btn btn-light w-auto">
                                                 Rispondi via mail
                                                 {{-- <i class="fa-solid fa-envelope-open fs-2 mx-3"></i> --}}
                                             </a>
                                         </div>
                                     </div>
                                 </td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
             @endforeach
            </div>
         @endif
         
         <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        </div>
    @endsection
