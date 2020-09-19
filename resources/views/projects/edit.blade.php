@extends('layouts.app')

@section('content')
    {{-- MOBILE --}}
    <div id="page" class="container mx-auto mt-12 lg:hidden">
        <form method="POST" action="{{ $project->path() }}">
            @csrf
            @method('PUT')
            @if($project->users()->where('role','=','creator')->get()->contains(Auth::user()->id))
                <div class="flex justify-center lg:justify-end lg:mr-6 mb-6">
                    <button class="bg-secondary text-white px-6 py-2 text-xs font-semibold rounded-lg" type="submit">Speichern</button>
                </div>
            @endif
            <div class="mt-4 mx-6 lg:w-1/3">
                <div class="flex justify-center mx-12">
                    <p class="font-semibold">Projekt Status</p>
                </div>
                <div class="flex justify-center mx-12 mt-2 mb-4">
                    <select name="projectStatus" class="border-secondary w-full border-2 rounded-lg">
                        @if($project->projectStatus == 'preparation')
                            <option value="preparation" selected>In Vorbereitung</option>
                        @else
                            <option value="preparation">In Vorbereitung</option>
                        @endif
                        @if($project->projectStatus == 'going')
                            <option value="going" selected>Im Gange</option>
                        @else
                            <option value="going">Im Gange</option>
                        @endif
                        @if($project->projectStatus == 'paused')
                            <option value="paused" selected>Pausiert</option>
                        @else
                            <option value="paused">Pausiert</option>
                        @endif
                        @if($project->projectStatus == 'successful')
                            <option value="successful" selected>Erfolgreich abgeschlossen</option>
                        @else
                            <option value="successful">Erfolgreich abgeschlossen</option>
                        @endif
                        @if($project->projectStatus == 'aborted')
                            <option value="aborted" selected>Abgebrochen</option>
                        @else
                            <option value="aborted">Abgebrochen</option>
                        @endif
                    </select>
                </div>
                <div class="flex justify-center mx-12">
                    <p class="font-semibold">Team Status</p>
                </div>
                <div class="flex justify-center mx-12 mt-2 mb-4">
                    <select name="teamStatus" class="border-secondary w-full border-2 rounded-lg">
                        @if($project->teamStatus == 'searching')
                            <option value="searching" selected>Teammitglieder gesucht</option>
                        @else
                            <option value="searching">Teammitglieder gesucht</option>
                        @endif
                        @if($project->teamStatus == 'complete')
                            <option value="complete" selected>Team vollständig</option>
                        @else
                            <option value="complete">Team vollständig</option>
                        @endif
                        @if($project->teamStatus == 'finished')
                            <option value="finished" selected>Abgeschlossen</option>
                        @else
                            <option value="finished">Abgeschlossen</option>
                        @endif
                    </select>
                </div>
                <p class="text-center break-words {{ $errors->has('title') ? 'text-red-600 text-sm' : 'text-secondary font-semibold uppercase text-xl' }}"
                   id="titleBlockMobile"
                   onclick="editOn('titleBlockMobile','titleTextareaMobile', 'titleBlockMobile', 'titleEditOff')">{{ $errors->has('title') ? 'Trage hier den Titel ein' : $project->title }}</p>
                <p onclick="editOff('titleBlockMobile','titleTextareaMobile', 'titleBlockMobile', 'titleEditOff')" class="text-right hidden" id="titleEditOff">
                    x
                </p>
                <textarea class="border-2 rounded h-auto overflow-y-scroll resize-none w-full uppercase text-xl font-semibold text-center hidden outline-none border-secondary"
                          maxlength="100"
                          rows="2"
                          name="title"
                          id="titleTextareaMobile"
                >{{ $errors->isEmpty() ? $project->title : old('title') }}</textarea>
            </div>
            <div class="w-2/3 mx-auto mb-6 lg:w-1/3">
                <p class="text-secondary text-center"> erstellt von <b>{{$project->users()->firstOrFail()->username}}</b></p>
            </div>
            <div class="mb-6">
                <img src="/uploads/project/default.jpg" alt="img" class="w-2/3 mx-auto object-cover">
            </div>
            <div class="mt-4 mx-12">
                <p class="text-center {{ $errors->has('summary') ? 'text-red-600 text-sm' : 'text-secondary' }}"
                   id="summaryBlockMobile"
                   onclick="editOn('summaryBlockMobile','summaryTextareaMobile', 'summaryBlockMobile', 'summaryEditOff')">{{ $errors->has('summary') ? 'Trage hier die Kurzbeschreibung ein' : $project->summary }}</p>
                <p onclick="editOff('summaryBlockMobile','summaryTextareaMobile', 'summaryBlockMobile', 'summaryEditOff')" class="text-right hidden" id="summaryEditOff">
                    x
                </p>
                <textarea class="text-center border-2 rounded resize-none w-full hidden outline-none border-secondary"
                          maxlength="255"
                          rows="5"
                          name="summary"
                          id="summaryTextareaMobile"
                >{{ $errors->isEmpty() ? $project->summary : old('summary') }}</textarea>
            </div>
            <div class="mt-4 mx-12">
                <label class="text-secondary text-lg font-semibold" for="skills">gesuchte Skills</label>
                <div class="h-32 border-2 rounded border-secondary overflow-y-scroll">
                    @foreach($skills as $skill)
                        @if($project->skills()->where('skill_id','=',$skill->id)->exists())
                            <div class="border border-2 border-muted">
                                <input type="checkbox" id="{{'skill' . $skill->id}}" name="skills[]" value="{{$skill->id}}" checked class="ml-1">
                                <label class="mt-1 ml-1" for="{{'skill' . $skill->id}}"> {{$skill->name}} </label>
                            </div>
                        @else
                            <div class="border border-2 border-muted">
                                <input type="checkbox" id="{{'skill' . $skill->id}}" name="skills[]" value="{{$skill->id}}" class="ml-1">
                                <label class="mt-1 ml-1" for="{{'skill' . $skill->id}}"> {{$skill->name}} </label>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="mt-4 mx-12">
                <label class="text-secondary text-lg font-semibold" for="tags">Themen</label>
                <div class="h-32 border-2 rounded border-secondary overflow-y-scroll">
                    @foreach($tags as $tag)
                        @if($project->tags()->where('tag_id','=',$tag->id)->exists())
                            <div class="border border-2 border-muted">
                                <input type="checkbox" id="{{'tag' . $tag->id}}" name="tags[]" value="{{$tag->id}}" checked class="ml-1">
                                <label class="mt-1 ml-1" for="{{'tag' . $tag->id}}"> {{$tag->name}} </label>
                            </div>
                        @else
                            <div class="border border-2 border-muted">
                                <input type="checkbox" id="{{'tag' . $tag->id}}" name="tags[]" value="{{$tag->id}}" class="ml-1">
                                <label class="mt-1 ml-1" for="{{'tag' . $tag->id}}"> {{$tag->name}} </label>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="border-t-2 border-gray-500 my-8 mx-12 lg:hidden">
            </div>
            <div class="mx-12 mt-4">
                <label class="text-secondary text-lg font-semibold" for="content">Beschreibung</label>
                <p class="mt-6 {{ $errors->has('content') ? 'text-red-600 text-sm text-center' : 'text-secondary' }}"
                   id="contentBlockMobile"
                   onclick="editOn('contentBlockMobile','contentTextareaMobile', 'contentBlockMobile', 'contentEditOff')">{{ $errors->has('content') ? 'Trage hier die Beschreibung ein' : $project->content }}</p>
                <p onclick="editOff('contentBlockMobile','contentTextareaMobile', 'contentBlockMobile', 'contentEditOff')" class="text-right hidden" id="contentEditOff">
                    x
                </p>
                <textarea class="textarea border-2 resize-none rounded w-full hidden p-1 outline-none border-secondary"
                          name="content"
                          rows="20"
                          id="contentTextareaMobile"
                >{{ $errors->isEmpty() ? $project->content : old('content') }}</textarea>
            </div>
            <div class="mx-12 mt-4">
                <label class="text-secondary text-lg font-semibold" for="users">Leute zum Team einladen</label>
                <div class="h-32 mb-16 border-2 rounded border-secondary overflow-y-scroll">
                    @foreach($users as $user)
                        @if($project->users()->where('user_id','=',$user->id)->exists())
                            <div class="border border-2 border-muted">
                                <input type="checkbox" id="{{'user' . $user->id}}" name="users[]" value="{{$user->id}}" checked class="ml-1">
                                <label for="{{'user' . $user->id}}"> {{$user->username}} </label>
                            </div>
                        @else
                            <div class="border border-2 border-muted">
                                <input type="checkbox" id="{{'user' . $user->id}}" name="users[]" value="{{$user->id}}" class="ml-1">
                                <label for="{{'user' . $user->id}}"> {{$user->username}} </label>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </form>
    </div>

    {{-- DESKTOP --}}


    <div class="flex flex-col mt-8 hidden lg:block">
        <form method="POST" action="{{ $project->path() }}">
            @csrf
            @method('PUT')
            @if($project->users()->where('role','=','creator')->get()->contains(Auth::user()->id))
                <div class="flex justify-end mr-6 mb-6">
                    <button class="bg-secondary text-white px-6 py-2 text-xs font-semibold rounded-lg" type="submit">Speichern</button>
                </div>
            @endif
            <div class="flex mt-8">
                <div class="w-1/3 mx-4">
                    <div class="flex justify-center mx-12">
                        <p class="font-semibold">Projekt Status</p>
                    </div>
                    <div class="flex justify-center mx-12 mt-2 mb-4">
                        <select name="projectStatus" class="border-secondary w-1/2 border-2 rounded-lg">
                            @if($project->projectStatus == 'preparation')
                                <option value="preparation" selected>In Vorbereitung</option>
                            @else
                                <option value="preparation">In Vorbereitung</option>
                            @endif
                            @if($project->projectStatus == 'going')
                                <option value="going" selected>Im Gange</option>
                            @else
                                <option value="going">Im Gange</option>
                            @endif
                            @if($project->projectStatus == 'paused')
                                <option value="paused" selected>Pausiert</option>
                            @else
                                <option value="paused">Pausiert</option>
                            @endif
                            @if($project->projectStatus == 'successful')
                                <option value="successful" selected>Erfolgreich abgeschlossen</option>
                            @else
                                <option value="successful">Erfolgreich abgeschlossen</option>
                            @endif
                            @if($project->projectStatus == 'aborted')
                                <option value="aborted" selected>Abgebrochen</option>
                            @else
                                <option value="aborted">Abgebrochen</option>
                            @endif
                        </select>
                    </div>
                    <div class="flex justify-center mx-12">
                        <p class="font-semibold">Team Status</p>
                    </div>
                    <div class="flex justify-center mx-12 mt-2 mb-4">
                        <select name="teamStatus" class="border-secondary w-1/2 border-2 rounded-lg">
                            @if($project->teamStatus == 'searching')
                                <option value="searching" selected>Teammitglieder gesucht</option>
                            @else
                                <option value="searching">Teammitglieder gesucht</option>
                            @endif
                            @if($project->teamStatus == 'complete')
                                <option value="complete" selected>Team vollständig</option>
                            @else
                                <option value="complete">Team vollständig</option>
                            @endif
                            @if($project->teamStatus == 'finished')
                                <option value="finished" selected>Abgeschlossen</option>
                            @else
                                <option value="finished">Abgeschlossen</option>
                            @endif
                        </select>
                    </div>
                    <div class="flex justify-center mx-12">
                        <p class="font-semibold ml-8">Titel</p>
                        <div class="w-10 -mt-2">
                            <img src="/uploads/project/BearbeitungsPen.png"
                                 onclick="editOn('titleBlockDesktop','titleTextareaDesktop', 'titleEditOnDesktop', 'titleEditOffDesktop')"
                                 id="titleEditOnDesktop">
                        </div>
                    </div>

                    <div class="flex justify-center mx-12">
                        <div class="flex justify-end w-10/12 xl:w-2/3">
                            <button class="w-8 h-8 border-2 border-secondary rounded-lg hidden bg-muted text-center mb-1"
                                    type="button"
                                    onclick="editOff('titleBlockDesktop','titleTextareaDesktop', 'titleEditOnDesktop', 'titleEditOffDesktop')"
                                    id="titleEditOffDesktop">x</button>
                        </div>
                    </div>
                    <div class="flex justify-center">
                            <p class="text-secondary uppercase text-xl font-semibold text-center break-all ml-2"
                               id="titleBlockDesktop" >{{ $errors->isEmpty() ? $project->title : old('title') }}</p>
                    </div>
                    <div class="mx-12 flex justify-center">
                        <textarea class=" border-2 rounded w-10/12 xl:w-2/3 resize-none uppercase text-xl hidden font-semibold text-center outline-none border-secondary"
                                  maxlength="100"
                                  rows="2"
                                  name="title"
                                  id="titleTextareaDesktop"

                        >{{ $errors->isEmpty() ? $project->title : old('title') }}</textarea>
                    </div>
                    @error('title')
                    <div class="flex justify-center">
                        <p class="text-red-600 text-xs">Fehlender Titel</p>
                    </div>
                    @enderror
                    <p class="text-secondary text-center"> erstellt von <b>{{$project->users()->firstOrFail()->username}}</b></p>
                    <div class=" border-t border-secondary mt-6 w-1/3 mx-auto">
                    </div>
                    <div class="mt-6 mx-12">
                        <p class="text-secondary font-semibold text-center mb-3">Themen</p>
                        <div class="h-40 mx-auto w-10/12 xl:w-2/3 border-2 rounded border-secondary overflow-y-scroll">
                            @foreach($tags as $tag)
                                @if($project->tags()->where('tag_id','=',$tag->id)->exists())
                                    <div class="border border-2 border-muted">
                                        <input type="checkbox" id="{{'tag' . $tag->id}}" name="tags[]" value="{{$tag->id}}" checked class="ml-1">
                                        <label class="mt-1 ml-1" for="{{'tag' . $tag->id}}"> {{$tag->name}} </label>
                                    </div>
                                @else
                                    <div class="border border-2 border-muted">
                                        <input type="checkbox" id="{{'tag' . $tag->id}}" name="tags[]" value="{{$tag->id}}" class="ml-1">
                                        <label class="mt-1 ml-1" for="{{'tag' . $tag->id}}"> {{$tag->name}} </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-16 mx-12">
                        <p class="text-secondary font-semibold text-center">Gesuchte Skills</p>
                        <div class="h-40 mx-auto w-10/12 xl:w-2/3 border-2 rounded border-secondary overflow-y-scroll">
                            @foreach($skills as $skill)
                                @if($project->skills()->where('skill_id','=',$skill->id)->exists())
                                    <div class="border border-2 border-muted">
                                        <input type="checkbox" id="{{'skill' . $skill->id}}" name="skills[]" value="{{$skill->id}}" checked class="ml-1">
                                        <label class="mt-1 ml-1" for="{{'skill' . $skill->id}}"> {{$skill->name}} </label>
                                    </div>
                                @else
                                    <div class="border border-2 border-muted">
                                        <input type="checkbox" id="{{'skill' . $skill->id}}" name="skills[]" value="{{$skill->id}}" class="ml-1">
                                        <label class="mt-1 ml-1" for="{{'skill' . $skill->id}}"> {{$skill->name}} </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class=" border-t border-secondary mt-16 w-1/3 mx-auto">
                    </div>
                    <div class="mt-6 mx-12">
                        <p class="text-secondary font-semibold text-center mb-4"> Team</p>
                        <div class="h-40 mx-auto w-10/12 xl:w-2/3 mb-16 border-2 rounded border-secondary overflow-y-scroll">
                            @foreach($users as $user)
                                @if($project->users()->where('user_id','=',$user->id)->exists())
                                    <div class="border border-2 border-muted">
                                        <input type="checkbox" id="{{'user' . $user->id}}" name="users[]" value="{{$user->id}}" checked class="ml-1">
                                        <label for="{{'user' . $user->id}}"> {{$user->username}} </label>
                                    </div>
                                @else
                                    <div class="border border-2 border-muted">
                                        <input type="checkbox" id="{{'user' . $user->id}}" name="users[]" value="{{$user->id}}" class="ml-1">
                                        <label for="{{'user' . $user->id}}"> {{$user->username}} </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="w-2/3 mx-4">
                    <div class="flex">
                        <div class="w-1/2 pr-16 mt-10 ">
                            <div id="image-upload"></div>
                        </div>
                        <div class="w-1/2 -ml-4 mr-12 mt-10">
                            <div class="flex">
                                <div>
                                    <p class="font-semibold">Kurzbeschreibung</p>
                                </div>
                                <div class="w-10 -mt-2">
                                    <img src="/uploads/project/BearbeitungsPen.png"
                                         onclick="editOn('summaryBlockDesktop','summaryTextareaDesktop', 'summaryEditOnDesktop', 'summaryEditOffDesktop')"
                                         id="summaryEditOnDesktop">
                                </div>
                            </div>
                            @error('summary')
                            <div>
                                <p class="text-red-600 text-xs">Fehlende Kurzbeschreibung</p>
                            </div>
                            @enderror
                            <div class="flex justify-end">
                                <button class="w-8 h-8 border-2 border-secondary rounded-lg hidden bg-muted text-center mb-1"
                                        type="button"
                                        onclick="editOff('summaryBlockDesktop','summaryTextareaDesktop', 'summaryEditOnDesktop', 'summaryEditOffDesktop')"
                                        id="summaryEditOffDesktop">x</button>
                            </div>
                            <p class="text-secondary"
                               id="summaryBlockDesktop">{{ $errors->isEmpty() ? $project->summary : old('summary') }}</p>

                            <textarea class="px-2 border-2 rounded resize-none hidden w-full outline-none border-secondary"
                                      maxlength="255"
                                      rows="10"
                                      name="summary"
                                      id="summaryTextareaDesktop"
                            >{{ $errors->isEmpty() ? $project->summary : old('summary') }}</textarea>
                        </div>
                    </div>
                    <div class=" border-t border-secondary mt-10 mr-12">
                    </div>
                    <div class="text-secondary my-12 mx-12">
                        <div class="flex">
                            <p class="text-secondary font-semibold mb-8">Beschreibung</p>
                            <div class="w-10 -mt-2">
                                <img src="/uploads/project/BearbeitungsPen.png"
                                     onclick="editOn('contentBlockDesktop','contentTextareaDesktop', 'contentEditOnDesktop', 'contentEditOffDesktop')"
                                     id="contentEditOnDesktop">
                            </div>
                        </div>
                        @error('content')
                        <div class="-mt-8">
                            <p class="text-red-600 text-xs">Fehlende Beschreibung</p>
                        </div>
                        @enderror
                        <div class="flex justify-end -mt-4">
                            <button class="w-8 h-8 border-2 border-secondary rounded-lg hidden bg-muted text-center mb-1"
                                    type="button"
                                    onclick="editOff('contentBlockDesktop','contentTextareaDesktop', 'contentEditOnDesktop', 'contentEditOffDesktop')"
                                    id="contentEditOffDesktop">x</button>
                        </div>
                        <p class="text-secondary mt-4"
                           id="contentBlockDesktop">{{ $errors->isEmpty() ? $project->content : old('content') }}</p>
                        <textarea class="textarea border-2 resize-none rounded hidden w-full px-2 outline-none border-secondary"
                                  name="content"
                                  rows="15"
                                  id="contentTextareaDesktop"
                        >{{ $errors->isEmpty() ? $project->content : old('content') }}</textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('webpage.scripts')
    <script>
        function editOn(blockElement, textAreaElement, buttonOn, buttonOff) {
            var block = document.getElementById(blockElement);
            var textArea = document.getElementById(textAreaElement);
            var On = document.getElementById(buttonOn);
            var Off = document.getElementById(buttonOff);

            block.classList.add("hidden");
            block.classList.remove("block");

            textArea.classList.remove("hidden");
            textArea.classList.add("block");

            Off.classList.remove("hidden");
            Off.classList.add("block");

            On.classList.add("hidden");
            On.classList.remove("block");
        }

        function editOff(blockElement, textAreaElement, buttonOn, buttonOff) {
            var block = document.getElementById(blockElement);
            var textArea = document.getElementById(textAreaElement);
            var On = document.getElementById(buttonOn);
            var Off = document.getElementById(buttonOff);

            textArea.classList.add("hidden");
            textArea.classList.remove("block");

            block.classList.remove("hidden");
            block.classList.add("block");

            Off.classList.add("hidden");
            Off.classList.remove("block");

            On.classList.remove("hidden");
            On.classList.add("block");

            block.innerHTML = textArea.value;
            setTextColor(blockElement);
        }

        function setTextColor(textElement) {
            var text = document.getElementById(textElement);
            text.classList.remove("text-red-600");
            text.classList.add("text-secondary");
        }
    </script>
    <script src="{{ mix('js/components/ImageCrop.js') }}"></script>
@endsection()
