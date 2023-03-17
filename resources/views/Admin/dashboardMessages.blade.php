@extends('layouts.dashboard')

@section('content')
   <a href="#top" class="position-fixed bottom-0 btn btn-info rounded-4 px-3 py-2 text-center"
      style="margin-left:-3.2rem; margin-bottom: 1rem">
      &uparrow;
   </a>
   @if (count($new_messages))
      <div>
         <div class="d-flex align-items-center">
            <h1 class="text-center">Nuovi messaggi: </h1>

            <div class="dropdown mx-3">
               <button class="btn btn-primary dropdown-toggle fs-5" type="button" data-bs-toggle="dropdown"
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
               <h3>
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
                           <a class="fs-4" data-bs-toggle="collapse" href="#collapseMessage{{ $varId }}"
                              role="button" aria-expanded="false" aria-controls="collapseExample">

                              <span>{{ $singleMessage['subject'] }}</span>
                           </a>
                           <div class="collapse" id="collapseMessage{{ $varId }}">
                              <div class="text-center fs-5  py-2">
                                 {{ $singleMessage['message'] }}
                              </div>
                           </div>
                        </td>
                        {{-- <td>
                           <a class="" data-bs-toggle="collapse" href="#collapseMessage{{ $key }}"
                              role="button" aria-expanded="false" aria-controls="collapseExample">
                              <span>{{ Str::limit($singleMessage['message'], 100, '...') }}</span>
                           </a>
                           <div class="collapse" id="collapseMessage{{ $key }}">
                              <div class="text-lignt">
                                 {{ $singleMessage['message'] }}
                              </div>
                           </div>
                        </td> --}}
                        {{-- <td class="text-end">

                        </td> --}}
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
                                 <a href="mailto:{{ $singleMessage['email'] }}" class="btn btn-light w-auto">
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
                     <a class="fs-4" data-bs-toggle="collapse" href="#collapseMessage{{ $varId }}" role="button"
                        aria-expanded="false" aria-controls="collapseExample">

                        <span>{{ $singleMessage['subject'] }}</span>
                     </a>
                     <div class="collapse" id="collapseMessage{{ $varId }}">
                        <div class="text-center py-2">
                           {{ $singleMessage['message'] }}
                        </div>
                     </div>
                  </td>
                  {{-- <td>
                  <a class="" data-bs-toggle="collapse" href="#collapseMessage{{ $key }}"
                     role="button" aria-expanded="false" aria-controls="collapseExample">
                     <span>{{ Str::limit($singleMessage['message'], 100, '...') }}</span>
                  </a>
                  <div class="collapse" id="collapseMessage{{ $key }}">
                     <div class="text-lignt">
                        {{ $singleMessage['message'] }}
                     </div>
                  </div>
               </td> --}}
                  {{-- <td class="text-end">

               </td> --}}
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
                           <a href="mailto:{{ $singleMessage['email'] }}" class="btn btn-light w-auto">
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

   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
@endsection
