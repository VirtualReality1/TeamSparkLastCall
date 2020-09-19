@extends('layouts.app')

@section('content')
    <div id="content" class="mt-12">
        @foreach($projects as $project)
            @if($loop->iteration % 2 == 1)
                <div>
                    <div class="lg:flex lg:flex-row lg:mr-12">
                        @endif
                        <div class="w-4/6 lg:w-1/2 mx-auto mt-6 lg:ml-12">
                            <p class="text-center text-base font-semibold uppercase mb-3 lg:text-left">{{ $project->title }}</p>
                            <div class="flex flex-col lg:flex-row">
                                <div class="lg:w-1/3">
                                    <img src="/uploads/project/default.jpg" alt="img" class="object-cover">
                                </div>
                                <div class="lg:w-2/3 lg:ml-6 mt-4 lg:mt-0" >
                                    <p>{{ $project->summary }}</p>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="lg:w-1/3 hidden lg:block">
                                </div>
                                <div class="lg:w-2/3 flex">
                                    <a class="font-semibold border-secondary border-2 rounded-full py-1 px-12 mt-4 mb-8 lg:ml-6" href="{{ $project->path() }}">Ansehen</a>
                                </div>
                            </div>
                            <div class="border-t-2 border-gray-500 lg:hidden">
                            </div>
                        </div>
                        @if($loop->iteration % 2 == 0 || $loop->last)
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection()
