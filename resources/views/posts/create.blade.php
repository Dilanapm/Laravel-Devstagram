@extends('layouts.app')

@section('titulo')
    Crea una nueva publicacion
@endsection
{{-- mala practica --}}
{{-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> --}}

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
@section('contenido')
    <div class="md:flex md:items-center">
        <div class=" md:w-1/2 px-10">
            <form action="{{ route('imagenes.store') }}" method="POST" id="dropzone" enctype="multipart/form-data" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <div class=" md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-8">
            <form action="{{route('posts.store')}}" method="POST" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input 
                    id="titulo"
                    {{-- name="name" es lo que se envía al servidor --}}
                    name="titulo"
                    type="text"
                    placeholder="Tu titulo"
                    class=" border p-3 w-full rounded-lg @error('name'
                    )
                         border-red-600
                    @enderror"
                    value="{{ old('titulo') }}"
                    />
                    @error('titulo')
                        <p class=" bg-red-500 text-white font-bold rounded-lg text-sm my-2 p-3">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripcion
                    </label>
                    <textarea 
                    id="descripcion"
                    {{-- name="name" es lo que se envía al servidor --}}
                    name="descripcion"
                    placeholder="descripcion"
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

                <div class="mb-5">
                    <input name="imagen" type="hidden" value="{{ old('imagen') }}"                    />
                    @error('imagen')
                        <p class=" bg-red-500 text-white font-bold rounded-lg text-sm my-2 p-3">{{$message}}</p>
                    @enderror

                </div>
                <input 
                type="submit"
                value="Crear Post"
                class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3 w-full text-white rounded-lg"
                >
            </form>
        </div>

    </div>
@endsection