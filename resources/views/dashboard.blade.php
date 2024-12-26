@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
    <div class=" flex justify-center ">
        <div class=" w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}" alt="imagen de usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10">
                {{-- {{dd($user)}} --}}
                <p class="text-gray-700 text-2xl">{{ $user->username}}</p>
                <p class=" text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class=" font-normal">Seguidores</span>
                </p>
                <p class=" text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class=" font-normal">Seguiendo</span>
                </p>
                <p class=" text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class=" font-normal">Posts</span>
                </p>
            </div>
            

            </p>
        </div>


    </div>
    <section>
        <h2 class=" text-4xl text-center font-black my-10">Publicaciones</h2>
        @if ($posts->count())
            
        
        <div class=" grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($posts as $post )
            <div>
                <a href="{{route('posts.show', ['post'=>$post,'user'=>$user])}}">
                    <img src="{{ asset('uploads').'/'. $post->imagen }}" alt="Imagen del post {{$post->titulo}}">
                </a>
            </div>
        @endforeach
        
       
    </div>
    <div class="my-10">
        {{$posts->links()}}
    </div>
    @else
    <a class=" text-gray-600 uppercase text-sm text-center font-bold"> No hay post por parte de este usuario</a>
    @endif
    </section>
@endsection