<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')
        <title>Destagram - @yield('titulo')</title>
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @livewireStyles
    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                
                    <a href="{{route('home')}}" class="text-3xl font-black">Devstagram</a>

                @auth  
                <nav class="flex gap-2 items-center">
                    <a class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer"
                    href="{{route('posts.create')}}">
                       <img class=" w-5" src="{{ asset('img/camara-reflex-digital.png') }}"> Crear
                    </a>
                    <a 
                    class=" font-bold text-gray-600 text-sm"
                    href="{{ route('posts.index',auth()->user()->username) }}">
                        Hola: <span class=" font-bold ">{{ auth()->user()->username }}</span>
                    </a>
                    
                    {{-- para logout se debe utilizar la directiva lo cual hace que sea necesario que este con un bloque de form para poder usarlo --}}
                    <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600 text-sm">
                            Cerrar sesion
                        </button>
                    </form>
                </nav> 
                @endauth

                @guest
                <nav class="flex gap-2 items-center">
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('login')}}">Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('register')}}">Crear Cuenta</a>
                </nav> 
                @endguest

                
            </div>
            
        </header>
        
        <main class=" container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>
            @yield('contenido')
        </main>
    <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
        Devstagram - Todos los derechos reservados 
        {{now()->year}}
    </footer>
    @livewireScripts
    </body>
</html>
