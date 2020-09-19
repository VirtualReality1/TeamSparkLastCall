@extends('layouts.app')
@section('content')
    <div id="wrapper">
        <div id="page" class="container mx-auto mt-4">
            <div class="mb-8">
                <h1 class="text-secondary uppercase text-2xl font-semibold ">Profil bearbeiten</h1>
            </div>

            <img src="{{ $user->getAvatar() }}"
                 style="width: 150px; height: 150px;  border-radius: 50%; margin-right: 25px; margin-bottom: 20px"
                 alt="img">

            <form enctype="multipart/form-data" action="{{route('profiles.avatar', $user->username)}}" method="POST">
                <br>
                <input type="file" name="avatar" accept="image/*">
                {{ csrf_field() }}
                <button
                    class="inline-block px-4 py-2 leading-none border-white hover:text-primary mt-4 lg:mt-0 font-bold"
                    type="submit">Speichern
                </button>
            </form>


            <form method="POST" action="{{route('profiles.update', $user)}}">
                @csrf
                @method('PUT')

                <div class="field mt-10">
                    <label class="label" for="username">Username</label>
                    <div class="control">
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-500 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('username') ? 'is-danger' : '' }}"
                            name="username"
                            id="username"
                            value="{{ $errors->isEmpty() ? $user->username : old('username')}}"
                            readonly
                            style="float: left"
                        >
                        <span class="text-sm text-gray-500">
                            Der Username kann nicht bearbeitet werden.
                        </span>

                        @if($errors->has('username'))
                            <p class="help is-danger">{{ $errors->first('username') }}</p>
                        @endif

                    </div>

                    <div class="field mt-4">
                        <label class="label" for="firstName">Vorname</label>
                        <div class="control">
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('firstName') ? 'is-danger' : '' }}"
                                name="firstName"
                                id="firstName"
                                value="{{ $errors->isEmpty() ? $user->firstName : old('firstName') }}"
                            >

                            @if($errors->has('firstName'))
                                <p class="help is-danger">{{ $errors->first('firstName') }}</p>
                            @endif

                        </div>
                    </div>

                    <div class="field mt-4">
                        <label class="label" for="lastName">Nachname</label>
                        <div class="control">
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('lastName') ? 'is-danger' : '' }}"
                                name="lastName"
                                id="lastName"
                                value="{{ $errors->isEmpty() ? $user->lastName : old('lastName') }}"
                            >

                            @if($errors->has('lastName'))
                                <p class="help is-danger">{{ $errors->first('lastName') }}</p>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="field mt-4 ">
                    <label class="label" for="dob">Geburtsdatum</label>
                    <div class="control">
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('firstName') ? 'is-danger' : '' }}"
                            type="date"
                            name="dob"
                            id="dob"
                            value="{{ $errors->isEmpty() ? $user->dob : old('dob') }}"
                        >

                        @if($errors->has('dob'))
                            <p class="help is-danger">{{ $errors->first('dob') }}</p>
                        @endif

                    </div>
                </div>

                <div class="field mt-4">
                    <label class="label" for="email">E-Mail</label>
                    <div class="control">
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('firstName') ? 'is-danger' : '' }}"
                            name="email"
                            id="email"
                            value="{{ $errors->isEmpty() ? $user->email : old('email') }}"
                        >

                        @if($errors->has('email'))
                            <p class="help is-danger">{{ $errors->first('email') }}</p>
                        @endif

                    </div>
                </div>

                <div class="flex flex-wrap mb-6 mt-4">
                    <label class="md:w-2/3 block">
                        <input class="mr-2 leading-tight" type="checkbox"
                               name="showMail" {{ $user->showMail ? 'checked' : '' }}>
                        <span class="text-sm">E-Mail Adresse in Profil anzeigen.</span>
                    </label>
                </div>

                <div class="field mt-4">
                    <label class="label " for="selfdescription">Über mich</label>

                    <div class="control ">
                        <textarea class="text shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('selfdescription') is-danger @enderror"
                                  name="selfdescription"
                                  id="selfdescription"
                                  style="height: max-content"
                        >{{ $errors->isEmpty() ? $user->selfdescription : old('selfdescription') }}</textarea>

                        @error('selfdescription')
                        <p class="help is-danger">{{ $errors->first('selfdescription') }}</p>
                        @enderror
                    </div>
                </div>
                <div class="field mt-4 w-1/4">
                    <label class="text-secondary text-lg font-semibold" for="tags">Themen</label>
                    <div class="h-32 border-2 rounded flex flex-col overflow-y-scroll">
                        @foreach($tags as $tag)
                            @if($user->tags()->where('tag_id','=',$tag->id)->exists())
                                <div>
                                    <input type="checkbox" id="{{'tag' . $tag->id}}" name="tags[]" value="{{$tag->id}}" checked class="ml-1">
                                    <label for="{{'tag' . $tag->id}}"> {{$tag->name}} </label>
                                </div>
                            @else
                                <div>
                                    <input type="checkbox" id="{{'tag' . $tag->id}}" name="tags[]" value="{{$tag->id}}" class="ml-1">
                                    <label for="{{'tag' . $tag->id}}"> {{$tag->name}} </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="field mt-4 w-1/4">
                    <label class="text-secondary text-lg font-semibold" for="skills">Skills</label>
                    <div class="h-32 border-2 rounded flex flex-col overflow-y-scroll">
                        @foreach($skills as $skill)
                            @if($user->skills()->where('skill_id','=',$skill->id)->exists())
                                <div>
                                    <input type="checkbox" id="{{'skill' . $skill->id}}" name="skills[]" value="{{$skill->id}}" checked class="ml-1">
                                    <label for="{{'skill' . $skill->id}}"> {{$skill->name}} </label>
                                </div>
                                @else
                                <div>
                                    <input type="checkbox" id="{{'skill' . $skill->id}}" name="skills[]" value="{{$skill->id}}" class="ml-1">
                                    <label for="{{'skill' . $skill->id}}"> {{$skill->name}} </label>
                                </div>
                            @endif
                        @endforeach
                     </div>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button
                            class="inline-block px-4 py-2 leading-none border-white hover:text-primary mt-4 lg:mt-0 font-bold"
                            type="submit">Speichern
                        </button>
                    </div>
                </div>
            </form>
        </div>
@endsection
