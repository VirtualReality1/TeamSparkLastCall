@extends('layouts.app')

@section('content')
    {{-- MOBILE --}}
    <div id="page" class="container mx-auto mt-12 lg:hidden">
        <form method="POST" action="/projects">
            @csrf
            <div class="flex justify-center lg:justify-end lg:mr-6 mb-6">
                <button class="bg-secondary text-white px-6 py-2 text-xs font-semibold rounded-lg" type="submit">
                    Erstellen
                </button>
            </div>

            <div class="mt-4 mx-6 lg:w-1/3">
                <p class="font-semibold text-lg text-center">Titel</p>
                @error('title')
                <div>
                    <p class="text-red-600 text-center text-xs">Fehlender Titel</p>
                </div>
                @enderror
                <textarea
                    class="border-2 mb-4 px-2 rounded h-auto overflow-y-scroll resize-none w-full uppercase text-xl font-semibold text-center outline-none border-secondary"
                    maxlength="100"
                    rows="2"
                    name="title"
                    placeholder="Hier kommt dein Titel hin"
                    id="titleTextareaMobile"
                >{{ old('title') }}</textarea>
            </div>

            <div class="mb-6">
                <img src="/uploads/project/default.jpg" alt="img" class="w-2/3 mx-auto object-cover">
            </div>
            <div class="mt-4 mx-12">
                <label class="text-secondary text-lg font-semibold" for="summary">Kurzbeschreibung</label>
                @error('summary')
                <div>
                    <p class="text-red-600 text-xs">Fehlende Kurzbeschreibung</p>
                </div>
                @enderror
                <textarea class="text-center border-2 rounded resize-none w-full outline-none border-secondary"
                          maxlength="255"
                          rows="5"
                          name="summary"
                          placeholder="Beschreib dein Projekt kurz"
                          id="summaryTextareaMobile"
                >{{ old('summary') }}</textarea>
            </div>
            <div class="mt-4 mx-12">
                <label class="text-secondary text-lg font-semibold" for="skills">gesuchte Skills</label>
                <div class="h-32 border-2 rounded border-secondary overflow-y-scroll">
                    @foreach($skills as $skill)
                        <div class="border border-2 border-muted">
                            <input type="checkbox" id="{{'skill' . $skill->id}}" name="skills[]" value="{{$skill->id}}"
                                   class="ml-1">
                            <label class="mt-1 ml-1" for="{{'skill' . $skill->id}}"> {{$skill->name}} </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-4 mx-12">
                <label class="text-secondary text-lg font-semibold" for="tags">Themen</label>
                <div class="h-32 border-2 rounded border-secondary overflow-y-scroll">
                    @foreach($tags as $tag)
                        <div class="border border-2 border-muted">
                            <input type="checkbox" id="{{'tag' . $tag->id}}" name="tags[]" value="{{$tag->id}}"
                                   class="ml-1">
                            <label class="mt-1 ml-1" for="{{'tag' . $tag->id}}"> {{$tag->name}} </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="border-t-2 border-gray-500 my-8 mx-12 lg:hidden">
            </div>
            <div class="mx-12 mt-4">
                <label class="text-secondary text-lg font-semibold" for="content">Beschreibung</label>
                @error('content')
                <div>
                    <p class="text-red-600 text-xs">Fehlende Beschreibung</p>
                </div>
                @enderror
                <textarea class="textarea border-2 resize-none rounded w-full p-1 outline-none border-secondary"
                          name="content"
                          rows="20"
                          placeholder="Erzähl etwas über dein Projekt"
                          id="contentTextareaMobile"
                >{{ old('content') }}</textarea>
            </div>
            <div class="mx-12 mt-4">
                <label class="text-secondary text-lg font-semibold" for="users">Leute zum Team einladen</label>
                <div class="h-32 mb-16 border-2 rounded border-secondary overflow-y-scroll">
                    @foreach($users as $user)
                        <div class="border border-2 border-muted">
                            <input type="checkbox" id="{{'user' . $user->id}}" name="users[]" value="{{$user->id}}"
                                   class="ml-1">
                            <label for="{{'user' . $user->id}}"> {{$user->username}} </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </form>
    </div>

    {{-- DESKTOP --}}

    <div class="flex flex-col mt-8 hidden lg:block">
        <form method="POST" action="/projects">
            @csrf
            <div class="flex justify-end mr-6 mb-6">
                <button class="bg-secondary text-white px-6 py-2 text-xs font-semibold rounded-lg" type="submit">
                    Erstellen
                </button>
            </div>
            <div class="flex mt-8">
                <div class="w-1/3 mx-4">
                    <div class="flex justify-center mx-12">
                        <p class="font-semibold">Titel</p>
                    </div>
                    @error('title')
                    <div class="flex justify-center">
                        <p class="text-red-600 text-xs">Fehlender Titel</p>
                    </div>
                    @enderror
                    <div class="mx-12 flex justify-center">
                        <textarea class="mt-1 border-2 rounded w-10/12 xl:w-2/3 resize-none text-lg text-center outline-none border-secondary"
                                  maxlength="100"
                                  rows="2"
                                  name="title"
                                  id="titleTextareaDesktop"
                        >{{ old('title') }}</textarea>
                    </div>
                    <div class=" border-t border-secondary mt-6 w-1/3 mx-auto">
                    </div>
                    <div class="mt-6 mx-12">
                        <p class="text-secondary font-semibold text-center mb-3">Themen</p>
                        <div class="h-40 mx-auto w-10/12 xl:w-2/3 border-2 rounded border-secondary overflow-y-scroll">
                            @foreach($tags as $tag)
                                <div class="border border-2 border-muted">
                                    <input type="checkbox" id="{{'tag' . $tag->id}}" name="tags[]" value="{{$tag->id}}"
                                           class="ml-1">
                                    <label class="mt-1 ml-1" for="{{'tag' . $tag->id}}"> {{$tag->name}} </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-16 mx-12">
                        <p class="text-secondary font-semibold text-center">Gesuchte Skills</p>
                        <div class="h-40 mx-auto w-10/12 xl:w-2/3 border-2 rounded border-secondary overflow-y-scroll">
                            @foreach($skills as $skill)
                                <div class="border border-2 border-muted">
                                    <input type="checkbox" id="{{'skill' . $skill->id}}" name="skills[]"
                                           value="{{$skill->id}}" class="ml-1">
                                    <label class="mt-1 ml-1" for="{{'skill' . $skill->id}}"> {{$skill->name}} </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class=" border-t border-secondary mt-16 w-1/3 mx-auto">
                    </div>
                    <div class="mt-6 mx-12">
                        <p class="text-secondary font-semibold text-center mb-4"> Team</p>
                        <div
                            class="h-40 mx-auto w-10/12 xl:w-2/3 mb-16 border-2 rounded border-secondary overflow-y-scroll">
                            @foreach($users as $user)
                                <div class="border border-2 border-muted">
                                    <input type="checkbox" id="{{'user' . $user->id}}" name="users[]"
                                           value="{{$user->id}}" class="ml-1">
                                    <label for="{{'user' . $user->id}}"> {{$user->username}} </label>
                                </div>
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
                            <div>
                                <p class="font-semibold">Kurzbeschreibung</p>
                            </div>
                            @error('summary')
                            <div>
                                <p class="text-red-600 text-xs">Fehlende Kurzbeschreibung</p>
                            </div>
                            @enderror
                            <textarea class="px-2 mt-1 border-2 rounded resize-none w-full outline-none border-secondary text-lg"
                                      maxlength="255"
                                      rows="10"
                                      name="summary"
                                      id="summaryTextareaDesktop"
                            >{{ old('summary') }}</textarea>
                        </div>
                    </div>
                    <div class=" border-t border-secondary mt-10 mr-12">
                    </div>
                    <div class="text-secondary my-12 mx-12">
                        <div>
                            <p class="text-secondary font-semibold mb-8">Beschreibung</p>
                        </div>
                        @error('content')
                        <div class="-mt-8">
                            <p class="text-red-600 text-xs">Fehlende Beschreibung</p>
                        </div>
                        @enderror
                        <textarea class="textarea mt-1 border-2 resize-none rounded w-full px-2 outline-none border-secondary text-lg"
                                  name="content"
                                  rows="15"
                                  id="contentTextareaDesktop"
                        >{{ old('content') }}</textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('webpage.scripts')
    <script src="{{ mix('js/components/ImageCrop.js') }}"></script>
@endsection
