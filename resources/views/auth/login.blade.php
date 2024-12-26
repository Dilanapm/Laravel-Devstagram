@extends('layouts.app')


@section('titulo')
    Inicia sesion en Devstagram
@endsection

@section('contenido')
    <div class = "md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-4/12">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen de login de usuarios">
        </div>
        <div class="md:w-4/12 bg-white p-5 shadow-xl rounded-lg" >
            <form method="POST" action="{{route('login')}}" novalidate>
                @csrf
                
                @if (session('mensaje'))

                <p class=" bg-red-500 text-white font-bold rounded-lg text-sm my-2 p-3">
                    {{session('mensaje')}}
                </p>
                    
                @endif

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
                    value="{{ old('password')}}"
                    />
                    @error('password')
                        <p class=" bg-red-500 text-white font-bold rounded-lg text-sm my-2 p-3">{{$message}}</p>
                    @enderror
                </div>
                
                <div class=" mb-5"> 
                    <input type="checkbox" name="remember"> <label class=" text-gray-500 text-sm">Mantener mi sesion abierta</label>
                </div>

                <input 
                type="submit"
                value="Iniciar Sesion"
                class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3 w-full text-white rounded-lg"
                >
            </form>
        </div>
    </div>


@endsection