<nav class="navbar navbar-expand-md navbar-primary shadow-sm  p-0">
   <div class="container-fluid px-md-5 d-flex align-items-md-end">
      <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">

         <div class="logo pt-2 {{-- all'espansione del burger deve allargarsi e avvicinarsi alle voci del menu --}}">

            {{-- AIRBNB-logo ------------------------------------da modificare --}}
            <img src="/images/BoolBnB_logo.png" alt="LOGO" class="header nav-logo pb-2 mb-2">
         </div>

      </a>

      <div class="flex-fill ps-3 pe-2 pe-lg-3 text-end">

         {{-- hamburger-menu --}}
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
         </button>

         {{-- funzione per recuperare il nome della rotta ----------------!!!!!!}}
         {{--   @dump(Route::getCurrentRoute()) --}}
         <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left Side Of Navbar -->
            <ul class="navbar nav me-md-auto align-items-end py-0">
               <li class="nav-item d-flex flex-column align-items-center">
                  <a class="nav-link fs-5  pt-md-4 px-2
                    {{ Route::currentRouteName() === null ? 'active' : '' }}"
                     {{--      href="{{ url('/') }}" --}} href="{{ $frontendURL }}">
                     {{ __('Home') }}</a>
                  <div class="link-underline m-3 mb-0"></div>
               </li>


               <li class="nav-item  d-flex flex-column align-items-center">
                  <a class="nav-link fs-5  pt-md-4 px-2" href="{{ $frontendURL }}/about">
                     {{ __('About') }}</a>
                  <div class="link-underline m-3 mb-0"></div>
               </li>
               <li class="nav-item  d-flex flex-column align-items-center">
                  <a class="nav-link fs-5  pt-md-4 px-2" href="{{ $frontendURL }}/contact">
                     {{ __('Contacts') }}</a>
                  <div class="link-underline m-3 mb-0"></div>
               </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto align-items-end">
               <!-- Authentication Links -->
               @guest
                  <li class="nav-item  d-flex flex-column align-items-center">
                     <a class="nav-link fs-5  pt-md-4 px-2
                         {{ Route::currentRouteName() === 'login' ? 'active' : '' }}"
                        href="{{ route('login') }}">{{ __('Login') }}</a>
                     <div class="link-underline m-3 mb-0"></div>
                  </li>

                  @if (Route::has('register'))
                     <li class="nav-item   d-flex flex-column align-items-center">
                        <a class="nav-link fs-5 pt-md-4 px-2
                            {{ Route::currentRouteName() === 'register' ? 'active' : '' }}"
                           href="{{ route('register') }}">{{ __('Register') }}</a>
                        <div class="link-underline m-3 mb-0"></div>
                     </li>
                  @endif
               @else
                  <li class="nav-item  dropdown">
                     <a id="navbarDropdown" class="nav-link dropdown-toggle fs-5" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                     </a>

                     <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item fs-5" href="{{ url('/Admin/dashboard') }}">{{ __('Dashboard') }}</a>
                        <a class="dropdown-item fs-5" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                           {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                           @csrf
                        </form>
                     </div>
                  </li>
               @endguest
            </ul>
         </div>
      </div>
   </div>
</nav>
