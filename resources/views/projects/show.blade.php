@extends('layouts.app')

@section('content')
    {{-- Mobile --}}
    <div class="mb-12 block lg:hidden">
        @if($project->users()->where('role','=','creator')->get()->contains(Auth::user()->id))
            <div class="text-center mb-4 mt-4 "><a class="underline" href="{{ route('projects.index') }}">Zurück</a> </div>
            <div class="flex justify-center lg:justify-end lg:mr-6 mb-6">
                <a href="{{ $project->path() }}/edit" class="border-secondary border-2 px-6 py-2 text-xs font-semibold rounded-lg">Projekt bearbeiten</a>
            </div>
        @endif
        <div class="mt-4 mb-6 mx-6 lg:w-1/3">
            @if($project->projectStatus == 'preparation')
                <div class="flex justify-center mb-4 cursor-default">
                    <p class="px-4 py-1 rounded-lg bg-muted text-sm">In Vorbereitung</p>
                </div>
            @endif
            @if($project->projectStatus == 'going')
                <div class="flex justify-center mb-4 cursor-default">
                    <p class="px-4 py-1 rounded-lg bg-secondary text-primary text-sm">Im Gange</p>
                </div>
            @endif
            @if($project->projectStatus == 'paused')
                <div class="flex justify-center mb-4 cursor-default">
                    <p class="px-4 py-1 rounded-lg bg-muted text-sm">Pausiert</p>
                </div>
            @endif
            @if($project->projectStatus == 'successful')
                <div class="flex justify-center mb-4 cursor-default">
                    <p class="px-4 py-1 rounded-lg bg-primary text-sm">Erfolgreich abgeschlossen</p>
                </div>
            @endif
            @if($project->projectStatus == 'aborted')
                <div class="flex justify-center mb-4 cursor-default">
                    <p class="px-4 py-1 rounded-lg bg-muted text-sm">Abgebrochen</p>
                </div>
            @endif
            @if($project->teamStatus == 'searching')
                <div class="flex justify-center mb-4 cursor-default">
                    <p class="px-4 py-1 rounded-lg bg-primary text-sm">Teammitglieder gesucht</p>
                </div>
            @endif
            @if($project->teamStatus == 'complete')
                <div class="flex justify-center mb-4 cursor-default">
                    <p class="px-4 py-1 rounded-lg bg-secondary text-primary text-sm">Team vollständig</p>
                </div>
            @endif
            @if($project->teamStatus == 'finished')
                <div class="flex justify-center mb-4 cursor-default">
                    <p class="px-4 py-1 rounded-lg bg-muted text-sm">Abgeschlossen</p>
                </div>
            @endif
            <p class="text-secondary uppercase text-xl lg:text-2xl text-center font-semibold break-words">{{ $project->title }}</p>
            <p class="text-secondary text-center mt-2"> erstellt  am {{$project->created_at->todatestring()}} von <b>{{$project->users()->firstOrFail()->username}}</b></p>
        </div>
        <div class="mb-6">

            <img src="/uploads/project/default.jpg" alt="img" class="w-2/3 mx-auto object-cover">
        </div>
        <div class="mx-12 md:mx-20 mb-6">
            <p class="text-secondary text-center">{{ $project->summary }}</p>
        </div>
        <div class="flex flex-row justify-center mx-6">
            <div class="flex flex-col w-2/5 mx-2">
                <p class="text-center text-secondary text-sm font-semibold">gesuchte Skills</p>
                @foreach($project->skills as $skill)
                    @if($loop->iteration < 4)
                        <div class="my-1">
                            <div class="flex justify-center">
                                <a href="#"class="w-full md:max-w-xs break-words text-center text-sm bg-secondary rounded-lg text-primary uppercase px-6 py-1">{{$skill->name}}</a>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="hidden -mt-1" id="extendSkills">
                    @foreach($project->skills as $skill)
                        @if($loop->iteration > 3)
                            <div class="my-2">
                                <div class="flex justify-center">
                                    <a href="#"class="w-full md:max-w-xs break-words text-center text-sm bg-secondary rounded-lg text-primary uppercase px-6 py-1">{{$skill->name}}</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                @foreach($project->skills as $skill)
                    @if($loop->iteration == 4)
                        <div>
                            <p onclick="extendOn('extendSkills', 'extendsSkillsOn','extendsSkillsOff')" class="block text-center text-xs underline cursor-pointer" id="extendsSkillsOn">Mehr anzeigen</p>
                            <p onclick="extendOff('extendSkills', 'extendsSkillsOn','extendsSkillsOff')" class="hidden text-center text-xs underline cursor-pointer" id="extendsSkillsOff">Weniger anzeigen</p>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="flex flex-col w-2/5 mx-2">
                <p class="text-center text-secondary text-sm font-semibold">Themen</p>
                @foreach($project->tags as $tag)
                    @if($loop->iteration < 4)
                        <div class="my-1">
                            <div class="flex justify-center">
                                <a href="#" class="w-full md:max-w-xs break-words text-center text-sm text-secondary border-secondary border-2 px-6 ">{{ $tag->name }}</a>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="hidden -mt-1" id="extendTags">
                    @foreach($project->tags as $tag)
                        <div class="my-2">
                            <div class="flex justify-center">
                                <a href="#" class="w-full md:max-w-xs break-words text-center text-sm text-secondary border-secondary border-2 px-6 ">{{ $tag->name }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                @foreach($project->tags as $tag)
                    @if($loop->iteration == 4)
                        <div class="">
                            <p onclick="extendOn('extendTags', 'extendsTagsOn','extendsTagsOff')" class="block text-center text-xs underline cursor-pointer" id="extendsTagsOn">Mehr anzeigen</p>
                            <p onclick="extendOff('extendTags', 'extendsTagsOn','extendsTagsOff')" class="hidden text-center text-xs underline cursor-pointer" id="extendsTagsOff">Weniger anzeigen</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="border-t-2 border-gray-500 my-8 mx-12 lg:hidden">
        </div>
        <div class="mx-12 mb-6">
            <p class="text-secondary font-semibold text-sm">Beschreibung</p>
        </div>
        <div class="mx-12 mb-8">
            <p class="text-secondary">{{ $project->content }}</p>
        </div>
        @unless($project->users()->where('role','=','creator')->get()->contains(Auth::user()->id) || $project->users()->where('role','=','member')->get()->contains(Auth::user()->id))
            <div class="flex justify-center mx-12 mb-8">
                @if($project->users()->where('role','=','interested')->get()->contains(Auth::user()->id))
                    <a href="{{ $project->path() }}/join"class="text-center bg-secondary text-white rounded-lg font-medium px-4 font-semibold py-2 cursor-pointer">Anfrage zurückziehen</a>
                @else
                    <a href="{{ $project->path() }}/join"class="text-center bg-orange-500 text-white rounded-full font-medium px-4 font-semibold py-1 cursor-pointer">Mitmachen</a>
                @endif
                {{--                        <a href="#" class="text-center bg-secondary text-white rounded-full font-medium py-1 mt-1 mb-6">Folgen</a> --}}
            </div>
        @endunless
        <div class="mb-4">
            <p class="text-center text-secondary font-semibold">Team</p>
        </div>
        <div>
            @foreach($project->users as $user)
                @if($user->pivot->role == 'creator')
                    <div class="flex flex-col justify-center mb-4">
                        <p class="text-center mb-2 font-semibold text-secondary">Ersteller</p>
                        <img src="{{ $user->getAvatar()}}"  alt="img" class="rounded-full border border-secondary w-1/5 mx-auto mb-2">
                        <a href="/profiles/{{ $user->username }}" class="text-center font-semibold text-secondary">{{ $user->username }}</a>
                    </div>
                @endif
                @if($user->pivot->role == 'member' && $loop->iteration < 6 )
                    <div class="flex flex-col justify-center mb-4">
                        <img src="{{ $user->getAvatar()}}"  alt="img" class="rounded-full border border-secondary w-1/5 mx-auto mb-2">
                        <a href="/profiles/{{ $user->username }}" class="text-center font-semibold text-secondary">{{ $user->username }}</a>
                    </div>
                @endif
            @endforeach
            <div class="hidden" id="extendUsers">
                @foreach($project->users as $user)
                    @if($user->pivot->role == 'member' && $loop->iteration > 5)
                        <div class="flex flex-col justify-center mb-4">
                            <img src="{{ $user->getAvatar()}}"  alt="img" class="rounded-full border border-secondary w-1/5 mx-auto mb-2">
                            <a href="/profiles/{{ $user->username }}" class="text-center font-semibold text-secondary">{{ $user->username }}</a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @foreach($project->users as $user)
            @if($loop->iteration == 5 )
                <div class="-mt-2">
                    <p onclick="extendOn('extendUsers', 'extendsUsersOn','extendsUsersOff')" class="block text-center underline cursor-pointer" id="extendsUsersOn">Mehr anzeigen</p>
                    <p onclick="extendOff('extendUsers', 'extendsUsersOn','extendsUsersOff')" class="hidden text-center underline cursor-pointer" id="extendsUsersOff">Weniger anzeigen</p>
                </div>
            @endif
        @endforeach
        @if($project->users()->where('role','=','creator')->get()->contains(Auth::user()->id))
            <div class="mb-4 mt-8">
                <p class="text-center text-secondary font-semibold">Interessenten</p>
            </div>
            @foreach($project->users as $user)
                @if($user->pivot->role == 'interested')
                    <div class="flex flex-col justify-center mb-4">
                        <img src="{{ $user->getAvatar()}}"  alt="img" class="rounded-full border border-secondary w-1/5 mx-auto mb-2">
                        <a href="/profiles/{{ $user->username }}" class="text-center font-semibold text-secondary">{{ $user->username }}</a>
                    </div>
                @endif
            @endforeach
        @endif
        @if($project->users()->where('role','=','creator')->get()->contains(Auth::user()->id))
            <div class="mb-4 mt-8">
                <p class="text-center text-secondary font-semibold">Eingeladene</p>
            </div>
            @foreach($project->users as $user)
                @if($user->pivot->role == 'invited')
                    <div class="flex flex-col justify-center mb-4">
                        <img src="{{ $user->getAvatar()}}"  alt="img" class="rounded-full border border-secondary w-1/5 mx-auto mb-2">
                        <a href="/profiles/{{ $user->username }}" class="text-center font-semibold text-secondary">{{ $user->username }}</a>
                    </div>
                @endif
            @endforeach
        @endif
    </div>

    {{-- Desktop --}}
    <div class="flex flex-col mt-8 hidden lg:block">

        @if($project->users()->where('role','=','creator')->get()->contains(Auth::user()->id))

            <div class="w-1/3 text-center mt-4 "><a class="underline" href="{{ route('projects.index') }}">Zurück</a> </div>
            <div class="flex justify-end mr-6 mb-6">

                <div><a href="{{ $project->path() }}/edit" class="border-secondary border-2 px-6 py-2 text-sm font-semibold rounded-lg">Projekt bearbeiten</a>
                </div>
                </div>
        @endif
        <div class="flex mt-8">
            <div class="w-1/3 mx-4">
                @if($project->projectStatus == 'preparation')
                    <div class="flex justify-center mb-4 cursor-default">
                        <p class="px-4 py-1 rounded-lg bg-muted text-sm">In Vorbereitung</p>
                    </div>
                @endif
                @if($project->projectStatus == 'going')
                    <div class="flex justify-center mb-4 cursor-default">
                        <p class="px-4 py-1 rounded-lg bg-secondary text-primary text-sm">Im Gange</p>
                    </div>
                @endif
                @if($project->projectStatus == 'paused')
                    <div class="flex justify-center mb-4 cursor-default">
                        <p class="px-4 py-1 rounded-lg bg-muted text-sm">Pausiert</p>
                    </div>
                @endif
                @if($project->projectStatus == 'successful')
                    <div class="flex justify-center mb-4 cursor-default">
                        <p class="px-4 py-1 rounded-lg bg-primary text-sm">Erfolgreich abgeschlossen</p>
                    </div>
                @endif
                @if($project->projectStatus == 'aborted')
                    <div class="flex justify-center mb-4 cursor-default">
                        <p class="px-4 py-1 rounded-lg bg-muted text-sm">Abgebrochen</p>
                    </div>
                @endif
                @if($project->teamStatus == 'searching')
                    <div class="flex justify-center mb-4 cursor-default">
                        <p class="px-4 py-1 rounded-lg bg-primary text-sm">Teammitglieder gesucht</p>
                    </div>
                @endif
                @if($project->teamStatus == 'complete')
                    <div class="flex justify-center mb-4 cursor-default">
                        <p class="px-4 py-1 rounded-lg bg-secondary text-primary text-sm">Team vollständig</p>
                    </div>
                @endif
                @if($project->teamStatus == 'finished')
                    <div class="flex justify-center mb-4 cursor-default">
                        <p class="px-4 py-1 rounded-lg bg-muted text-sm">Abgeschlossen</p>
                    </div>
                @endif
                <p class="text-secondary uppercase text-2xl font-semibold text-center break-all">{{ $project->title }}</p>
                <p class="text-secondary text-center mt-2"> erstellt  am {{$project->created_at->todatestring()}} von <b>{{$project->users()->firstOrFail()->username}}</b></p>
                <div class=" border-t border-secondary mt-6 w-1/3 mx-auto">
                </div>
                <div class="flex flex-col mt-6 mx-12">
                    <p class="text-secondary font-semibold text-center mb-3">Themen</p>
                    @foreach($project->tags as $tag)
                        @if($loop->iteration < 7)
                            @if($loop->iteration % 3 == 1)
                                @if($loop->last)
                                    <div class="flex flex-row justify-center flex-wrap">
                                        <a href="#" class="text-center text-sm text-secondary border-secondary border-2 my-1 px-6 mx-2 break-words">{{ $tag->name }}</a>
                                    </div>
                                @else
                                    <div class="flex flex-row justify-center flex-wrap">
                                        <a href="#" class="text-center text-sm text-secondary border-secondary border-2 my-1 px-6 mx-2 break-words">{{ $tag->name }}</a>
                                        @endif
                                        @endif
                                        @if($loop->iteration % 3 == 2)
                                            @if($loop->last)
                                                <a href="#" class="text-center text-sm text-secondary border-secondary border-2 my-1 px-6 mx-2 break-words">{{ $tag->name }}</a>
                                    </div>
                                    @else
                                        <a href="#" class="text-center text-sm text-secondary border-secondary border-2 my-1 px-6 mx-2 break-words">{{ $tag->name }}</a>
                                    @endif
                                @endif
                                @if($loop->iteration % 3 == 0)
                                    <a href="#" class="text-center text-sm text-secondary border-secondary border-2 my-1 px-6 mx-2 break-words">{{ $tag->name }}</a>
                </div>
                @endif
                @endif
                @endforeach
                <div class="hidden" id="extendTagsDesktop">
                    @foreach($project->tags as $tag)
                        @if($loop->iteration > 6)
                            @if($loop->iteration % 3 == 1)
                                @if($loop->last)
                                    <div class="flex flex-row justify-center flex-wrap">
                                        <a href="#" class="text-center text-sm text-secondary border-secondary border-2 my-1 px-6 mx-2 break-words">{{ $tag->name }}</a>
                                    </div>
                                @else
                                    <div class="flex flex-row justify-center flex-wrap">
                                        <a href="#" class="text-center text-sm text-secondary border-secondary border-2 my-1 px-6 mx-2 break-words">{{ $tag->name }}</a>
                                        @endif
                                        @endif
                                        @if($loop->iteration % 3 == 2)
                                            @if($loop->last)
                                                <a href="#" class="text-center text-sm text-secondary border-secondary border-2 my-1 px-6 mx-2 break-words">{{ $tag->name }}</a>
                                    </div>
                                    @else
                                        <a href="#" class="text-center text-sm text-secondary border-secondary border-2 my-1 px-6 mx-2 break-words">{{ $tag->name }}</a>
                                    @endif
                                @endif
                                @if($loop->iteration % 3 == 0)
                                    <a href="#" class="text-center text-sm text-secondary border-secondary border-2 my-1 px-6 mx-2 break-words">{{ $tag->name }}</a>
                </div>
                @endif
                @endif
                @endforeach
            </div>
            @foreach($project->tags as $tag)
                @if($loop->iteration == 7)
                    <p onclick="extendOn('extendTagsDesktop', 'extendsTagsOnDesktop','extendsTagsOffDesktop')" class="block text-center underline mt-2" id="extendsTagsOnDesktop">Mehr anzeigen</p>
                    <p onclick="extendOff('extendTagsDesktop', 'extendsTagsOnDesktop','extendsTagsOffDesktop')" class="hidden text-center underline mt-2" id="extendsTagsOffDesktop">Weniger anzeigen</p>
                @endif
            @endforeach
        </div>
        <div class="mt-16">
            <p class="text-secondary font-semibold text-center">Gesuchte Skills</p>
            <div class="flex w-1/3 xl:w-1/4 flex-col mx-auto mt-3">
                @foreach($project->skills as $skill)
                    @if($loop->iteration < 4 )
                        <a href="#"class="text-center bg-secondary text-primary rounded-lg font-medium uppercase py-1 my-1 break-words">{{$skill->name}}</a>
                    @endif
                @endforeach
                <div class="flex flex-col hidden" id="extendSkillsDesktop">
                    @foreach($project->skills as $skill)
                        @if($loop->iteration > 3 )
                            <a href="#"class="text-center bg-secondary text-primary rounded-lg font-medium uppercase py-1 my-1 break-words">{{$skill->name}}</a>
                        @endif
                    @endforeach
                </div>
                @foreach($project->skills as $skill)
                    @if($loop->iteration == 4 )
                        <p onclick="extendOn('extendSkillsDesktop', 'extendsSkillsOnDesktop','extendsSkillsOffDesktop')" class="block text-center underline mt-2" id="extendsSkillsOnDesktop">Mehr anzeigen</p>
                        <p onclick="extendOff('extendSkillsDesktop', 'extendsSkillsOnDesktop','extendsSkillsOffDesktop')" class="hidden text-center underline mt-2" id="extendsSkillsOffDesktop">Weniger anzeigen</p>
                    @endif
                @endforeach
            </div>
        </div>
        <div class=" border-t border-secondary mt-16 w-1/3 mx-auto">
        </div>
        <div class="mt-10 flex flex-col w-1/5 mx-auto">
            @unless($project->users()->where('role','=','creator')->get()->contains(Auth::user()->id) || $project->users()->where('role','=','member')->get()->contains(Auth::user()->id))
                @if($project->users()->where('role','=','interested')->get()->contains(Auth::user()->id))
                    <a href="{{ $project->path() }}/join"class="text-center bg-secondary text-white rounded-lg font-medium py-2 my-1">Anfrage zurückziehen</a>
                @else
                    <a href="{{ $project->path() }}/join"class="text-center bg-orange-500 text-white rounded-full font-medium py-1 my-1">Mitmachen</a>
                @endif
                {{--                        <a href="#" class="text-center bg-secondary text-white rounded-full font-medium py-1 mt-1 mb-6">Folgen</a>--}}
            @endunless
        </div>
        <div class="mt-6">
            <p class="text-secondary font-semibold text-center mb-4"> Team</p>
            <div class="flex flex-col w-1/5 mx-auto">
                @foreach($project->users as $user)
                    @if($user->pivot->role == 'creator')
                        <p class="text-center mb-2 font-semibold text-secondary">Ersteller</p>
                        <img src="{{ $user->getAvatar()}}"  alt="img" class="w-3/4 rounded-full border border-secondary mx-auto">
                        <a href="/profiles/{{ $user->username }}" class="text-center mt-3 mb-4 font-semibold text-secondary">{{ $user->username }}</a>
                    @endif
                @endforeach
                @foreach($project->users as $user)
                    @if($user->pivot->role == 'member' && $loop->iteration < 6 )
                        <img src="{{ $user->getAvatar()}}" alt="img" class="w-3/4 rounded-full border border-secondary mx-auto">
                        <a href="/profiles/{{ $user->username }}" class="text-center mt-3 mb-4 font-semibold text-secondary">{{ $user->username }}</a>
                    @endif
                @endforeach
                <div class="hidden flex flex-col mx-auto" id="extendUsersDesktop">
                    @foreach($project->users as $user)
                        @if($user->pivot->role == 'member' && $loop->iteration > 5)
                            <img src="{{ $user->getAvatar()}}" alt="img" class="w-3/4 rounded-full border border-secondary mx-auto">
                            <a href="/profiles/{{ $user->username }}" class="text-center mt-3 mb-4 font-semibold text-secondary">{{ $user->username }}</a>
                        @endif
                    @endforeach
                </div>
                @foreach($project->users as $user)
                    @if($loop->iteration == 5 )
                        <p onclick="extendOn('extendUsersDesktop', 'extendsUsersOnDesktop','extendsUsersOffDesktop')" class="block text-center underline mt-2" id="extendsUsersOnDesktop">Mehr anzeigen</p>
                        <p onclick="extendOff('extendUsersDesktop', 'extendsUsersOnDesktop','extendsUsersOffDesktop')" class="hidden text-center underline mt-2" id="extendsUsersOffDesktop">Weniger anzeigen</p>
                    @endif
                @endforeach
                @if($project->users()->where('role','=','creator')->get()->contains(Auth::user()->id))
                    <p class="text-center mb-4 mt-6 font-semibold text-secondary">Interessiert</p>
                    @foreach($project->users as $user)
                        @if($user->pivot->role == 'interested')
                            <img src="{{ $user->getAvatar()}}" alt="img" class="w-3/4 rounded-full border border-secondary mx-auto">
                            <a href="/profiles/{{ $user->username }}" class="text-center mt-3 mb-4 font-semibold text-secondary">{{ $user->username }}</a>
                        @endif
                    @endforeach
                @endif
                @if($project->users()->where('role','=','creator')->get()->contains(Auth::user()->id))
                    <p class="text-center mb-4 mt-6 font-semibold text-secondary">Eingeladen</p>
                    @foreach($project->users as $user)
                        @if($user->pivot->role == 'invited')
                            <img src="{{ $user->getAvatar()}}" alt="img" class="w-3/4 rounded-full border border-secondary mx-auto">
                            <a href="/profiles/{{ $user->username }}" class="text-center mt-3 mb-4 font-semibold text-secondary">{{ $user->username }}</a>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="w-2/3 mx-4">
        <div class="flex">
            <div class="w-1/2 pr-16 mt-10 ">
                <img src="/uploads/project/default.jpg" alt="img" class="object-cover">
            </div>
            <div class="w-1/2 -ml-4 mt-10">
                <p class="text-secondary mr-12">{{ $project->summary }}</p>
            </div>
        </div>
        <div class=" border-t border-secondary mt-10 mr-12">
        </div>
        <div class="text-secondary mt-12 mx-12 ">
            <p class="text-secondary font-semibold text-lg">Beschreibung</p>
            <p class="mt-8 text-secondary">{{ $project->content }}</p>
        </div>
    </div>
    </div>
    </div>

@endsection()

@section('webpage.scripts')
    <script>
        function extendOn(element, open, close) {
            var element = document.getElementById(element);
            var open = document.getElementById(open);
            var close = document.getElementById(close);
            element.classList.remove("hidden");
            element.classList.add("block");
            open.classList.remove("block");
            open.classList.add("hidden");
            close.classList.remove("hidden");
            close.classList.add("block");
        }
        function extendOff(element, open, close) {
            var element = document.getElementById(element);
            var open = document.getElementById(open);
            var close = document.getElementById(close);
            element.classList.add("hidden");
            element.classList.remove("block");
            close.classList.remove("block");
            close.classList.add("hidden");
            open.classList.remove("hidden");
            open.classList.add("block");
        }
    </script>
@endsection
