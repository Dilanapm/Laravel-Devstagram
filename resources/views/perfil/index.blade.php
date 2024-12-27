@extends('layouts.app')

@section('titulo')
 Editar perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
    <div class=" md:flex md:justify-center">
        <div class=" md:w-1/2 bg-white shadow p-6">
        <form action="{{route('perfil.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                    Username
                </label>
                <input 
                id="username"
                {{-- name="name" es lo que se envía al servidor --}}
                name="username"
                type="text"
                placeholder="Tu nombre de usuario"
                class=" border p-3 w-full rounded-lg @error('username'
                )
                     border-red-600
                @enderror"
                value="{{ auth()->user()->username }}"
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
                value="{{ auth()->user()->email }}"
                />
                @error('email')
                    <p class=" bg-red-500 text-white font-bold rounded-lg text-sm my-2 p-3">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                    Imagen de perfil
                </label>
                <input 
                id="imagen"
                {{-- name="name" es lo que se envía al servidor --}}
                name="imagen"
                type="file"
                
                class=" border p-3 w-full rounded-lg 
                value=""
                accept=".jpg, .jpeg, .png"
                />
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                    password
                </label>
                <input 
                id="password"
                name="password"
                type="password"
                placeholder="Deja este campo vacío si no quieres cambiar tu contraseña"
                class=" border p-3 w-full rounded-lg @error('password'
                )
                     border-red-600
                @enderror"
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
                placeholder="Repite tu password si es que lo quieres cambiar"
                class="border p-3 w-full rounded-lg"
                />
            </div>
            <input 
            type="submit"
            value="Guardar cambios"
            class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3 w-full text-white rounded-lg"
            >
        </form>
        </div>
    </div>
@endsection