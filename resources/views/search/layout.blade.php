@extends('layouts.app')

@section('content')
    <div class="text-center text-secondary font-semibold tracking-wider my-8">
        <p class="uppercase text-lg">Matching</p>
    </div>
    <div class="flex uppercase justify-center text-secondary font-semibold text-sm py-2">
        @if (\Route::current()->getName() == 'search.user' || \Route::current()->getName() == 'search.user.project')
            <a href="{{ route('search.user') }}" class="mx-16 border-b-2 border-secondary">Personen</a>
            <a href="{{ route('search.project') }}" class="mx-16">Projekte</a>
        @else
            <a href="{{ route('search.user') }}" class="mx-16">Personen</a>
            <a href="{{ route('search.project') }}" class="mx-16 border-b-2 border-secondary">Projekte</a>
        @endif
    </div>
    <div class="bg-muted lg:py-2 flex flex-col lg:flex-row">
        @hasSection('container-left')
            <div class="lg:w-1/3 flex justify-center items-center flex-col">
                @yield('container-left')
            </div>
        @endif
        @hasSection('container-right')
            <div
                class="lg:mx-2 bg-white rounded-lg w-full lg:w-2/3 text-secondary font-semibold tracking-wider px-8 overflow-auto h-screen">
                @yield('container-right')
            </div>
        @endif
        @hasSection('container')
            <div
                class="lg:mx-20 bg-white lg:rounded-lg w-full text-secondary font-semibold tracking-wider overflow-auto h-screen">
                @yield('container')
            </div>
        @endif
    </div>
@endsection
