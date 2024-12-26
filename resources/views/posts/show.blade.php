@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection

@section('contenido')
    <div class=" container mx-auto flex">
        <div class=" md:w-1/2">
            <img src="{{ asset('uploads').'/'.$post->imagen}}" alt="Imagen del post {{$post->titulo}}">

            <div class=" p-3">
                <p> 0 likes</p>
            </div>

            <div>
                {{-- el post puede encontrar al usuario porque esta relacionado inversamente --}}
                <p class=" font-bold">{{$post->user->username}}</p>
                <p class=" text-sm text-gray-500">
                    {{$post->created_at->diffForHumans()}}
                    {{-- diffForHumans funciona gracias a la API Carbon que ya viene con laravel --}}
                </p>
                <p class="mt-5">
                    {{$post->descripcion}}
                </p>
            </div>
        </div>
        <div class="md:w-1/2 p-5">
            <div class=" shadow bg-white p-5 mb-5">
                @auth
                    
                
                <p class=" text-xl font-bold text-center mb-4">
                    Agrega un Nuevo Comentario
                </p>
                <form action="">
                    <div class="mb-5">
                        <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                            Comentarios
                        </label>
                        <textarea 
                        id="comentario"
                        {{-- name="name" es lo que se envía al servidor --}}
                        name="comentario"
                        placeholder="Agrega un Comentario"
                        class=" border p-3 w-full rounded-lg @error('name'
                        )
                             border-red-600
                        @enderror"
                        value="{{ old('descripcion') }}"
                        > </textarea>
                        @error('descripcion')
                            <p class=" bg-red-500 text-white font-bold rounded-lg text-sm my-2 p-3">{{$message}}</p>
                        @enderror
                    </div>

                    <input 
                    type="submit"
                    value="Crear Post"
                    class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3 w-full text-white rounded-lg"
                    >
                </form>
                @endauth
            </div>
        </div>
    </div>

@endsection