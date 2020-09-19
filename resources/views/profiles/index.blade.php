@extends('layouts.app')

@section('content')
    <div class="text-center " id="content" class="mt-12">
        @foreach($users as $user)
            <div class="w-1/2">
                <div class="flex">
                    <div class="w-1/3 text-center mt-10">
                        <div class="ml-6 mb-4">
                            <img src="{{ $user->getAvatar() }}"
                                 style="width: 150px; height: 150px; border-radius: 50%; margin-right: 25px;"
                                 alt="img">
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/3 pr-10">
                        <p class="font-semibold">{{ $user-> username}}</p>
                        <p>{{$user -> firstName}} {{$user -> lastName}}</p>
                        @if($user->showMail)
                            <p>{{ $user->email }}</p>
                        @endif
                    </div>
                    <div class="w-1/3 text-left mt-6">
                        <a class="font-semibold border-secondary border-2 rounded-full py-1 px-12 "
                           href="{{ route('profiles.show', $user->username) }}">Ansehen</a>
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/3 mx-6">

                    </div>

                </div>
            </div>
        @endforeach
    </div>
@endsection()
