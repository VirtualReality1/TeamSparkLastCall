@extends('search.layout')

@section('container-left')
<div class="my-8 lg:my-0">
    <a class="underline" href="{{ route('search.user') }}">Zurück</a>
</div>
<div class="mt-8 hidden lg:block">
    <img src="{{ 'https://picsum.photos/id/'.$project->id.'/500/300' }}" alt="#">
</div>
<div class="w-2/3 mt-8 hidden lg:flex">
    @foreach($project->skills as $skill)
        @if($loop->iteration > 3)    {{-- Shows first 3 skills --}}
        @break
        @endif
        <p class="bg-secondary text-primary mt-2 mx-4 rounded-full text-center uppercase w-1/3">
            {{ \Illuminate\Support\Str::limit($skill->name, '9', '...') }}  </p>
    @endforeach
</div>
<div class="w-2/3 mt-2 hidden lg:flex">
    @foreach($project->tags as $tag)
        @if($loop->iteration > 3)    {{-- Shows first 3 tags --}}
        @break
        @endif
        <p class="border-2 border-secondary text-center mt-2 mx-4 uppercase w-1/3">
            {{ \Illuminate\Support\Str::limit($tag->name, '9', '...') }}  </p>
    @endforeach
</div>
@endsection

@section('container-right')
    <p class="mt-12 text-center">Passende User für dein Projekt:</p>
    @if($users->isEmpty())
        <div class="pt-40 w-2/3">
            <p class="text-gray-500">
                Tut uns Leid. Es gibt gerade keine User, die zu deinem Projekt passen. Probier doch mal, die Themen oder
                benötigten Skills zu bearbeiten. Vielleicht wird es dann was ;)
            </p>
        </div>
    @endif
    @foreach ($users as $user)
        <div class="flex flex-col lg:flex-row">
            <a href="{{ route('profiles.show', $user->username) }}"
               class="flex flex-col my-8 w-full lg:w-1/6 items-center">
                <img src="{{ $user->getAvatar() }}" alt="#" class="rounded-full w-64 lg:w-24">
                <p class="uppercase pt-8 text-center">{{ $user->firstName }} {{ $user->lastName }}</p>
                <p class="font-normal text-sm"><span>@</span>{{ $user->username}}</p>
            </a>
            <div class="flex flex-col my-8 w-full lg:w-1/6 items-center">
                <p>Skills</p>
                <div class="w-full px-4 flex flex-col items-center">
                    @foreach($user->skills as $skill)
                        @if($loop->iteration > 3)     {{-- Shows first 3 skills --}}
                        @break
                        @endif
                        <x-skill>{{ $skill->name }}</x-skill>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col my-8 w-full lg:w-1/6 items-center">
                <p>Interessen</p>
                <div class="w-full px-4 flex flex-col items-center">
                    @foreach($user->tags as $tag)
                        @if($loop->iteration > 3)     {{-- Shows first 3 tags --}}
                        @break
                        @endif
                        <x-tag>{{ $tag->name }}</x-tag>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col px-8 my-8 w-full lg:w-1/2 text-center lg:text-left">
                <p>Info</p>
                <p class="font-normal pt-8">{{ $user->selfdescription }}</p>
                <div class="text-center">
                    <a href="{{ route('profiles.show', $user->username) }}" class="text-lg">+</a>
                </div>
            </div>
</div>
@if (!$loop->last)
<hr>
@endif
@endforeach
@endsection
