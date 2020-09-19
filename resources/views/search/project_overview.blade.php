@extends('search.layout')
@section('container')
    <div class="text-center text-secondary font-semibold tracking-wider">
        <p class="mt-12">Wähle ein Projekt, um Mitstreiter dafür zu suchen:</p>
    </div>
    @if($projects->isEmpty())
        <div class="pt-40">
            <p class="text-gray-500 text-center">
                Sieht aus, als hättest du noch kein Projekt erstellt.
            </p>
        </div>
    @endif
    <div class="flex flex-wrap flex-col lg:flex-row">
        @foreach($projects as $project)
            @if($project->users()->where('role','=','creator')->get()->contains(Auth::user()->id))
            <a href="{{ route('search.user.project', $project) }}"
               class="w-full lg:w-1/2 flex flex-col text-center py-8 lg:px-8">
                <p class="font-semibold text-xl tracking-wider uppercase">{{ $project->title }}</p>
                <img class="flex-auto w-full mt-8" src="{{ 'https://picsum.photos/id/'.$project->id.'/500/300' }}"
                     alt="#">
            </a>
            @endif
        @endforeach
    </div>
@endsection
