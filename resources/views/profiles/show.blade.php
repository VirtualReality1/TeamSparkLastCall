@extends('layouts.app')

@section('content')
    <div class="mt-16">
        <div class="mb-12">
            @if ($user == Auth::user())
                <p class="mt-10 text-center lg:float-right">
                    <a href="{{ route('profiles.edit', $user) }}"
                       class="font-semibold border-secondary border-2 rounded-full py-3 px-8 lg:object-right lg:-ml-16 lg:mr-16">Profil
                        bearbeiten</a>
                </p>
            @endif
        </div>
        <div class="flex flex-col lg:flex-row ">
            <div class="lg:w-1/3 ">
                <center class="ml-6">
                    <img src="{{ $user->getAvatar() }}"
                         style="width: 150px; height: 150px;  border-radius: 50%; margin-right: 25px;"
                         alt="img">
                </center>

                <p class="text-secondary uppercase text-xl font-semibold text-center">{{ $user-> firstName}} {{ $user-> lastName}}</p>
                <p class="text-secondary text-center"> @ {{ $user ->username }}</p>
                @if($user == Auth::user() || $user->showMail)

                    <p class="text-secondary text-center mt-2">{{$user->email}} </p>

                @endif
                @unless(Auth::user()->id == $user->id)
                    <div class="mt-10 flex flex-col w-1/5 mx-auto">

                        <p onclick="inviteOn()"
                           class="text-center bg-orange-500 text-white rounded-full font-medium py-1 my-1">Einladen</p>

                        <div id="invitePopUp" class="absolute hidden">
                            <div class="ml-16 bg-white border-2 rounded-lg border-secondary">
                                <div class="flex justify-end">
                                    <div class="flex">
                                        <p onclick="inviteOff()" class="mr-2">X</p>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-secondary font-semibold">Lade {{$user->username}} zu einem Projekt
                                        ein:</p>
                                </div>
                                <div class="flex flex-col">
                                    @foreach(Auth::user()->projects as $project)
                                        <div class="flex">
                                            @if($project->users()->where('role','=','creator')->get()->contains(Auth::user()->id))
                                                <div class="flex">
                                                    <p class="ml-3 mb-2 py-2">{{$project->title}}</p>
                                                </div>
                                                @if($project->users()->where('role','=','invited')->get()->contains($user->id))
                                                    <div class="flex flex-auto justify-end mr-4">
                                                        <a href="{{ route('profiles.invite', [$user, $project]) }}"
                                                           class=" ml-8 mb-2 py-2 px-1 text-center bg-secondary text-white rounded-lg font-medium">Anfrage
                                                            zurückziehen</a>
                                                    </div>
                                                @elseif($project->users()->where('role','=','member')->get()->contains($user->id))
                                                    <div class="flex flex-auto justify-end mr-4">
                                                        <p class="ml-8 mb-2 py-2 px-1 bg-muted rounded-lg">bereits
                                                            dabei</p>
                                                    </div>
                                                @else
                                                    <div class="flex flex-auto justify-end mr-4">
                                                        <a href="{{ route('profiles.invite', [$user, $project]) }}"
                                                           class="ml-8 mb-2 py-2 px-1 text-center bg-orange-500 text-white rounded-lg font-medium">einladen</a>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{--                    <a href="#"--}}
                        {{--                       class="text-center bg-secondary text-white rounded-full font-medium py-1 my-1">Folgen</a>--}}
                    </div>
                @endunless

                <div class=" border-t border-secondary mt-8 w-1/2 lg:w-2/3  mx-auto">
                </div>

                <div class="flex" style="display: inline-list-item; ">
                    <div class="w-1/3 text-center mx-auto mt-5">
                        <div class=" flex text-center " style="display: table; margin: auto">
                            <p class="text-secondary font-semibold mb-4 text-center md:-mr-8 lg:-mr-16 ">Skills</p>
                            @foreach($user->skills as $skill)
                                @if($loop->iteration < 4)
                                    <p class="bg-secondary text-primary text-sm rounded-full font-medium uppercase py-1 my-1 mx-2 md:-mr-8 lg:-mr-16">{{$skill->name}}</p>
                                @endif
                            @endforeach
                            <div class="hidden" id="extendSkills">
                                @foreach($user->skills as $skill)
                                    @if($loop->iteration > 3)
                                        <p class="bg-secondary text-primary rounded-full font-medium uppercase py-1 my-1 mx-2 md:-mr-8 lg:-mr-16">{{$skill->name}}</p>
                                    @endif
                                @endforeach
                            </div>
                            @foreach($user->tags as $tag)
                                @if($loop->iteration == 4)
                                    <div class="mx-auto">
                                        <p onclick="extendsSkillsOn()"
                                           class="block text-center text-sm underline mt-2  md:-mr-8 lg:-mr-16"
                                           id="extendsSkillsOn">Mehr anzeigen</p>
                                        <p onclick="extendsSkillsOff()"
                                           class="hidden text-center text-sm underline mt-2 md:-mr-8 lg:-mr-16"
                                           id="extendsSkillsOff">Weniger anzeigen</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="w-1/3 text-center mx-auto mt-5">
                        <div class="flex sm:flex-col text-center " style="display: table;">
                            <p class="text-secondary font-semibold text-center mb-4 md:-mr-8 lg:-mr-16">Themen</p>
                            @foreach($user->tags as $tag)
                                @if($loop->iteration < 4)
                                    <p class="text-sm text-secondary border-secondary font-medium uppercase border-2 my-1 px-1 mx-2 md:-mr-8 lg:-mr-16">{{$tag->name}}</p>
                                @endif
                            @endforeach
                            <div class="hidden" id="extendTags">
                                @foreach($user->tags as $tag)
                                    @if($loop->iteration > 3)
                                        <p class="text-sm text-secondary border-secondary font-medium uppercase border-2 my-1 px-1 mx-2 md:-mr-8 lg:-mr-16">{{$tag->name}}</p>
                                    @endif
                                @endforeach
                            </div>
                            @foreach($user->tags as $tag)
                                @if($loop->iteration == 4)
                                    <div class="mx-auto">
                                        <p onclick="extendsTagsOn()"
                                           class="block text-center text-sm underline mt-2 md:-mr-8 lg:-mr-16 "
                                           id="extendsTagsOn">Mehr anzeigen</p>
                                        <p onclick="extendsTagsOff()"
                                           class="hidden text-center text-sm underline mt-2  md:-mr-8 lg:-mr-16"
                                           id="extendsTagsOff">Weniger anzeigen</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-auto lg:mx-32 lg:w-2/3 ">
                <div class="flex flex-col">
                    <div class="text-secondary mx-auto mt-12 lg:ml-0">
                        <p class="text-secondary font-semibold text-lg lg:float-left ">Über mich</p>
                        <p class="mt-12 text-secondary">{{ $user -> selfdescription}}</p>
                    </div>
                </div>

                <div class=" border-t border-secondary mt-8 w-1/2 lg:w-full mx-auto">
                </div>

                <div class="mb-5">
                    <div class="text-secondary mt-10  ">
                        <p class="text-secondary font-semibold text-lg text-center lg:float-left flex flex-col">Projekte</p>
                        <div class="text-secondary mt-4 text-center">
                            <a class="mr-4">Aktuelle Projekte</a>
                            <a> Abgeschlossene Projekte</a>
                        </div>
                    </div>
                </div>
                <div class="container mt-8 "
                     style="background-color: rgba(200,200,200, 0.15); border-radius: 25px; padding: 20px">
                    <div class="w-1/3 mx-6">
                        <img src="/uploads/project/default.jpg" alt="img" class="object-cover">
                    </div>
                    {{--                   @foreach($users-> projects as $project)--}}
                    {{--                        @if($loop->iteration % 2 == 0)--}}
                    {{--                            <div class="w-1/2">--}}
                    {{--                                <div class="flex">--}}
                    {{--                                    <div class="w-1/3 text-center">--}}
                    {{--                                        <div class="ml-6 mb-4">--}}
                    {{--                                            <p class="text-3xl font-semibold uppercase">{{ $project->title }}</p>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="flex">--}}
                    {{--                                    <div class="w-2/3 pr-10" >--}}
                    {{--                                        <p>{{ $project->summary }}</p>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="flex">--}}
                    {{--                                    <div class="w-1/3 mx-6">--}}

                    {{--                                    </div>--}}
                    {{--                                    <div class="w-2/3 text-left mt-6">--}}
                    {{--                                        <a class="font-semibold border-secondary border-2 rounded-full py-1 px-12 " href="{{ $project->path() }}">Ansehen</a>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        @endif--}}
                    {{--                    @endforeach--}}
                </div>
            </div>

        </div>


        @endsection()

        @section('webpage.scripts')
            <script>
                function inviteOn() {
                    var element = document.getElementById("invitePopUp");
                    element.classList.remove("hidden");
                    element.classList.add("block");
                }

                function inviteOff() {
                    var element = document.getElementById("invitePopUp");
                    element.classList.add("hidden");
                    element.classList.remove("block");
                }

                function extendsSkillsOn() {
                    var element = document.getElementById("extendSkills");
                    var open = document.getElementById("extendsSkillsOn");
                    var close = document.getElementById("extendsSkillsOff");
                    element.classList.remove("hidden");
                    element.classList.add("block");
                    open.classList.remove("block");
                    open.classList.add("hidden");
                    close.classList.remove("hidden");
                    close.classList.add("block");
                }

                function extendsSkillsOff() {
                    var element = document.getElementById("extendSkills");
                    var open = document.getElementById("extendsSkillsOn");
                    var close = document.getElementById("extendsSkillsOff");
                    element.classList.add("hidden");
                    element.classList.remove("block");
                    close.classList.remove("block");
                    close.classList.add("hidden");
                    open.classList.remove("hidden");
                    open.classList.add("block");
                }

                function extendsTagsOn() {
                    var element = document.getElementById("extendTags");
                    var open = document.getElementById("extendsTagsOn");
                    var close = document.getElementById("extendsTagsOff");
                    element.classList.remove("hidden");
                    element.classList.add("block");
                    open.classList.remove("block");
                    open.classList.add("hidden");
                    close.classList.remove("hidden");
                    close.classList.add("block");
                }

                function extendsTagsOff() {
                    var element = document.getElementById("extendTags");
                    var open = document.getElementById("extendsTagsOn");
                    var close = document.getElementById("extendsTagsOff");
                    element.classList.add("hidden");
                    element.classList.remove("block");
                    close.classList.remove("block");
                    close.classList.add("hidden");
                    open.classList.remove("hidden");
                    open.classList.add("block");
                }
            </script>
@endsection
