<nav class="flex items-center justify-between flex-wrap bg-white p-6 border-b-2 border-secondary fixed top-0 w-full">
    <div class="flex items-center w-1/3">
        <a href="{{ route('index') }}">
            <svg class="fill-current h-12 w-12 mr-2 transform hover:rotate-180 transition duration-1000" width="100%"
                 height="100%" viewBox="0 0 45 45" version="1.1"
                 xmlns="http://www.w3.org/2000/svg" xml:space="preserve"
                 style="fill-rule:evenodd;clip-rule:evenodd;stroke-miterlimit:2;">
            <path
                d="M43.421,22.455c0,11.579 -9.387,20.966 -20.966,20.966c-11.58,0 -20.966,-9.387 -20.966,-20.966c0,-11.58 9.386,-20.966 20.966,-20.966c11.579,0 20.966,9.386 20.966,20.966Z"
                style="fill:#002859;fill-rule:nonzero;"/>
                <path
                    d="M43.421,22.455c0,11.579 -9.387,20.966 -20.966,20.966c-11.58,0 -20.966,-9.387 -20.966,-20.966c0,-11.58 9.386,-20.966 20.966,-20.966c11.579,0 20.966,9.386 20.966,20.966Z"
                    style="fill:none;stroke:#002859;stroke-width:1.33px;"/>
                <path
                    d="M26.932,5.747l-11.625,14.23l-6.086,-8.455c0,0 3.183,-3.822 7.229,-5.255c5.268,-1.865 10.482,-0.52 10.482,-0.52Z"
                    style="fill:#0f9;fill-rule:nonzero;"/>
                <path
                    d="M10.969,25.359l-5.478,0.381c0,0 -0.443,-2.255 -0.208,-4.842c0.225,-2.486 1.284,-5.235 1.284,-5.235l7.954,5.221l-3.552,4.475Z"
                    style="fill:#0f9;fill-rule:nonzero;"/>
                <path
                    d="M13.318,37.063c0,0 -1.528,-0.825 -3.514,-2.894c-1.745,-1.818 -2.671,-3.762 -2.671,-3.762l4.264,-4.496l8.624,-0.719l-6.703,11.871Z"
                    style="fill:#0f9;fill-rule:nonzero;"/>
                <path
                    d="M19.507,39.305c0,0 -0.605,-0.031 -1.788,-0.448c-1.344,-0.474 -1.656,-0.639 -1.656,-0.639l5.57,-13.107l2.973,-0.237l-5.099,14.431Z"
                    style="fill:#0f9;fill-rule:nonzero;"/>
                <path
                    d="M30.093,37.97c0,0 -2.435,1.168 -5.306,1.339c-3.341,0.199 -4.836,0.207 -4.836,0.207l5.851,-8.407l4.291,6.861Z"
                    style="fill:#0f9;fill-rule:nonzero;"/>
                <path
                    d="M39.628,21.238l-5.615,-1.806l-7.844,11.192l6.417,5.766c0,0 3.98,-2.853 5.752,-7.25c1.932,-4.791 1.29,-7.902 1.29,-7.902Z"
                    style="fill:#0f9;fill-rule:nonzero;"/>
                <path
                    d="M37.925,14.847c0,0 0.114,-0.48 -1.526,-2.604c-1.328,-1.722 -2.42,-2.612 -2.42,-2.612l-5.914,9.47l5.877,-0.467l3.983,-3.787Z"
                    style="fill:#0f9;fill-rule:nonzero;"/>
                <path
                    d="M25.794,19.224l-4.457,0.354l5.988,-13.431c0,0 1.038,0.244 2.184,0.82c1.345,0.675 1.869,1.207 1.869,1.207l-5.584,11.05Z"
                    style="fill:#0f9;fill-rule:nonzero;"/>
                <path
                    d="M39.434,22.444c0,9.303 -7.635,16.845 -17.054,16.845c-9.419,0 -17.054,-7.542 -17.054,-16.845c0,-9.304 7.635,-16.846 17.054,-16.846c9.419,0 17.054,7.542 17.054,16.846Z"
                    style="fill:none;stroke:#002859;stroke-width:1.18px;"/></svg>
        </a>
        <a href="{{ route('index') }}" class="font-semibold text-xl tracking-wider uppercase">Teamspark</a>
    </div>
    <div class="block lg:hidden">
        <button id="nav-burger"
                class="flex items-center px-3 py-2 border-2 rounded  border-secondary hover:text-primary hover:border-primary">
            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
            </svg>
        </button>
    </div>
    <div class="lg:w-2/3 w-full hidden lg:flex items-center justify-between flex-wrap" id="nav-menu">
        @auth
            <div class="text-sm lg:w-1/2 lg:flex lg:justify-center text-center block w-full">
                <a href="{{ route('projects.create') }}"
                   class="lg:w-1/2 w-full inline-block uppercase rounded bg-muted p-4 lg:mx-2 lg:my-0 my-4 font-semibold hover:text-primary hover:bg-secondary">
                    Projekt erstellen
                </a>
                <a href="{{ route('search.user') }}"
                   class="lg:w-1/2 w-full inline-block uppercase rounded bg-muted p-4 lg:mx-2 font-semibold hover:text-primary hover:bg-secondary">
                    Matching
                </a>
            </div>
            <div class="text-xl lg:w-1/3 lg:flex lg:justify-end lg:items-center w-full">
                <div id="feedback" data-csrf="{!! csrf_token() !!}"
                     data-consent="{!! config('feedback.consent') !!}"></div>
                <div class="mx-2 dropdown lg:inline-block relative hidden">
                    <img src="{{ Auth::user()->getAvatar() }}" alt="picture" class="rounded-full w-10 h-10">
                    <ul class="dropdown-menu absolute hidden right-0 pt-1">
                        <li class=""><a
                                class="bg-white border-2 border-b-0 hover:bg-muted border-secondary py-2 px-4 block whitespace-no-wrap"
                                href="{{ route('profiles.show', Auth::user()->username) }}">Profil</a></li>
                        <li class=""><a
                                class="bg-white border-2 border-t-0 hover:bg-muted border-secondary py-2 px-4 block whitespace-no-wrap"
                                href="{{ route('logout') }}">Abmelden</a></li>
                    </ul>
                </div>
            </div>
            <div class="lg:hidden block w-full border-t-2 border-secondary mt-4 text-xl pt-4">
                <a href="{{ route('profiles.show', Auth::user()->username) }}" class="block">Profil</a>
                <a href="{{ route('logout') }}">Abmelden</a>
            </div>
        @else
            <div class="text-xl block w-full lg:flex lg:justify-end">
                <div>
                    <a href="{{ route('login') }}"
                       class="inline-block px-4 py-2 leading-none border-white hover:text-primary mt-4 lg:mt-0 font-bold">Anmelden</a>
                </div>
                <div>
                    <a href="{{ route('register') }}"
                       class="inline-block px-4 py-1 leading-none border-2 rounded-lg border-secondary hover:border-primary hover:text-primary mt-4 lg:mt-0">Registrieren</a>
                </div>
            </div>
        @endauth
    </div>
</nav>
