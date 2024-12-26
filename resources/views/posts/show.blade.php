@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection

@section('contenido')
    <div class=" container mx-auto md:flex">
        <div class=" md:w-1/2">
            <img src="{{ asset('uploads').'/'.$post->imagen}}" alt="Imagen del post {{$post->titulo}}">

            <div class=" p-3 flex items-center gap-4">
                @auth
                @if ($post->checkLike(auth()->user()))

                <form action="{{route('posts.likes.destroy', $post)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="my-4">
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="purple" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                              </svg>
                        </button>
                    </div>
                    
                      
                </form>
                    
                @else
                <form action="{{route('posts.likes.store', $post)}}" method="POST">
                    @csrf
                    <div class="my-4">
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                              </svg>
                        </button>
                    </div>
                    
                      
                </form>
                @endif
                
                
                @endauth
                <p> <span class=" font-bold">{{ $post->likes->count() }}</span> likes</p>
            </div>

            <div>
                {{-- el post puede encontrar al usuario porque esta relacionado inversamente --}}
                <p class=" font-bold text-purple-800">{{$post->user->username}}</p>
                <p class=" text-sm text-gray-500">
                    {{$post->created_at->diffForHumans()}}
                    {{-- diffForHumans funciona gracias a la API Carbon que ya viene con laravel --}}
                </p>
                <p class="mt-5">
                    {{$post->descripcion}}
                </p>
            </div>

            @auth
            {{-- la persona que esta autenticada es la misma que posteo la publicacion --}}
            @if ($post->user_id === auth()->user()->id)
            <form action="{{route('posts.destroy', $post)}}" method="POST">
                {{-- METODO SPOOFING --}}
                @method('DELETE') 
                @csrf
                <input 
                type="submit"
                value="Eliminar publicacion"
                class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                >
            </form>
            @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            <div class=" shadow bg-white p-5 mb-5">
                <p class=" text-xl font-bold text-center mb-4">
                   Comentarios
                </p>
                @auth
                    
                
                <p class=" text-xl font-bold text-center mb-4">
                    Agrega un Nuevo Comentario
                </p>
                @if (session('mensaje'))
                    <div class=" bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold ">
                        {{session('mensaje')}}
                    </div>
                @endif
                <form action="{{route('comentarios.store', ['post'=>$post,'user'=>$user])}}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                            Comentarios
                        </label>
                        <textarea 
                        id="comentario"
                        {{-- name="name" es lo que se envía al servidor --}}
                        name="comentario"
                        placeholder="Agrega un Comentario"
                        class=" border p-3 w-full rounded-lg"
                        value="{{ old('comentario') }}"
                        > </textarea>
                       
                    </div>

                    <input 
                    type="submit"
                    value="Comentar"
                    class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold p-3 w-full text-white rounded-lg"
                    >
                </form>
                @endauth
                <div class=" bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    {{-- {{dd($post->comentarios)}} --}}
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{route('posts.index',$comentario->user)}}" class="font-bold text-purple-800 text-lg">
                                    {{$comentario->user->username}}
                                </a>
                                <p>{{$comentario->comentario}}</p>
                                <p class=" text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection