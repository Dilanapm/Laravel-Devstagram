@extends('layouts.app')


@section('titulo')
    Registrate en Devstagram
@endsection

@section('contenido')
    <div class = "md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-4/12">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen de registro de usuarios">
        </div>
        <div class="md:w-4/12 bg-white p-5 shadow-xl rounded-lg" >
            <form action="{{route('register')}}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input 
                    id="name"
                    {{-- name="name" es lo que se envía al servidor --}}
                    name="name"
                    type="text"
                    placeholder="Tu nombre"
                    class=" border p-3 w-full rounded-lg @error('name'
                    )
                         border-red-600
                    @enderror"
                    value="{{ old('name') }}"
                    />
                    @error('name')
                        <p class=" bg-red-500 text-white font-bold rounded-lg text-sm my-2 p-3">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input 
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Tu nombre de usuario"
                    class=" border p-3 w-full rounded-lg @error('username'
                    )
                         border-red-600
                    @enderror"
                    value="{{ old('username') }}"
                    />
                    @error('username')
                        <p class=" bg-red-500 text-white font-bold rounded-lg text-sm my-2 p-3">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input 
                    id="email"
                    name="email"
                    type="text"
                    placeholder="Tu email aquí"
                    class=" border p-3 w-full rounded-lg @error('email'
                    )
                         border-red-600
                    @enderror"
                    value="{{ old('email') }}"
                    />
                    @error('email')
                        <p class=" bg-red-500 text-white font-bold rounded-lg text-sm my-2 p-3">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        password
                    </label>
                    <input 
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Tu password aquí"
                    class=" border p-3 w-full rounded-lg @error('password'
                    )
                         border-red-600
                    @enderror"
                    value="{{ old('password') }}"
                    />
                    @error('password')
                        <p class=" bg-red-500 text-white font-bold rounded-lg text-sm my-2 p-3">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                       Repite tu password
                    </label>
                    <input 
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    placeholder="Repite tu password"
                    class="border p-3 w-full rounded-lg"
                    />
                </div>

                <input 
                type="submit"
                value="Crear cuenta"
                class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3 w-full text-white rounded-lg"
                >
            </form>
        </div>
    </div>


@endsection