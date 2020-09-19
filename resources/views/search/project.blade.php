@extends('search.layout')

@section('container-left')
    <div>
        <img src="{{ Auth::user()->getAvatar() }}" alt="#" class="rounded-full w-24 h-24">
    </div>
    <div class="text-secondary pt-8 text-center hidden lg:block">
        <p class="uppercase font-semibold tracking-wide tracking-wider text-xl">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</p>
        <p><span>@</span>{{ Auth::user()->username }}</p>
    </div>
    <div class="w-2/3 hidden lg:flex">
        @foreach(Auth::user()->skills as $skill)
            @if($loop->iteration > 3)    {{-- Shows first 3 skills --}}
            @break
            @endif
            <p class="bg-secondary text-primary mt-2 mx-4 rounded-full text-center text-sm uppercase w-1/3">
                {{ \Illuminate\Support\Str::limit($skill->name, '9', '...') }}  </p>
        @endforeach

    </div>
    <div class="w-2/3 mt-2 hidden lg:flex">
        @foreach(Auth::user()->tags as $tag)
            @if($loop->iteration > 3)     {{-- Shows first 3 tags --}}
            @break
            @endif
            <p class="border-2 border-secondary text-center mt-2 mx-4 text-sm uppercase w-1/3">
                {{ \Illuminate\Support\Str::limit($tag->name, '9', '...') }}  </p>
        @endforeach
    </div>
@endsection

@section('container-right')
    <p class="mt-12 text-center lg:text-left">Für dich geeignete Projekte:</p>
    @if($projects->isEmpty())
        <p class="text-gray-500">
            Tut uns Leid. Es gibt gerade keine Projekte, die zu deinem Profil passen.
            Probier doch mal, deine Themen oder Skills zu bearbeiten. Vielleicht wird es dann was ;)
        </p>
    @endif

    @foreach ($projects as $project)
        <div class="flex flex-col lg:flex-row my-8 items-center">
            <div class="w-full lg:w-1/2">
                <a href="{{ route('projects.show', $project) }}">
                    <img class="w-full"
                         src="{{ 'https://picsum.photos/id/'.$project->id.'/500/300' }}" alt="#">
                </a>
            </div>
            <div class="w-full lg:w-1/2 flex flex-col lg:flex-row">
                <div class="w-full lg:w-1/3">
                    <div class="lg:mx-4">
                        @foreach($project->skills as $skill)
                            @if($loop->iteration > 3)     {{-- Shows first 3 skills --}}
                            @break
                            @endif
                            <x-skill>{{ $skill->name }}</x-skill>
                        @endforeach
                    </div>
                    <div class="mt-8 lg:mx-4">
                        @foreach($project->tags as $tag)
                            @if($loop->iteration > 3)     {{-- Shows first 3 tags --}}
                            @break
                            @endif
                            <x-tag>{{ $tag->name }}</x-tag>
                        @endforeach
                    </div>
                </div>
                <div class="lg:w-2/3 mt-8 lg:mt-0 text-center lg:text-left order-first lg:order-none">
                    <a class="text-2xl lg:text-base"
                       href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                    <p class="font-normal pt-8">{{ \Illuminate\Support\Str::limit($project->summary, '100', '...') }}</p>
                    <div class="text-center">
                        <a href="{{ route('projects.show', $project) }}" class="text-lg">+</a>
                    </div>
                </div>
            </div>
        </div>
        @if(!$loop->last)
            <hr>
        @endif

    @endforeach
@endsection
