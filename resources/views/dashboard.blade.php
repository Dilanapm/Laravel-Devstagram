@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
    <div class=" flex justify-center ">
        <div class=" w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ $user->imagen ? 
                asset('perfiles').'/'.$user->imagen :
                asset('img/usuario.svg')
                }}" alt="imagen de usuario">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10">
                {{-- {{dd($user)}} --}}
                <div class="flex items-center gap-2">
                <p class="text-gray-700 text-2xl">{{ $user->username}}</p>
                
                @auth
                    @if ($user->id === auth()->user()->id)
                        <a href="{{route('perfil.index')}}" 
                        class="text-gray-500 hover:text-gray-600 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                              </svg>
                              
                        </a>
                    @endif
                @endauth
                </div>
                <p class=" text-gray-800 text-sm mb-3 font-bold">
                    {{ $user ->followers->count()}}
                    <span class=" font-normal">@choice('Seguidor|
                    Seguidores',$user ->followers->count())</span>
                </p>
                <p class=" text-gray-800 text-sm mb-3 font-bold">
                    {{ $user ->followings->count()}}
                    <span class=" font-normal">Seguiendo</span>
                </p>
                <p class=" text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts->count()}}
                    <span class=" font-normal">Posts</span>
                </p>
               @auth
                @if ($user->id !== auth()->user()->id)
                    @if($user->siguiendo(auth()->user()))
                 {{-- "$user" es la persona que esta siendo visitada y "auth()->user" es la persona que lo esta visitando  --}}
                        <form action="{{route('users.unfollow', $user)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input 
                            type="submit"
                            class="bg-red-500 text-white uppercase rounded-lg px-3 py-1 cursor-pointer font-bold text-xs"
                            value="Dejar de seguir"
                            >
                        </form>
                    @else
                        <form 
                        method="POST"
                        action="{{ route('users.follow', $user) }}" 
                        
                        >
                        @csrf
                        <input 
                        type="submit"
                        class="bg-blue-500 text-white uppercase rounded-lg px-3 py-1 cursor-pointer font-bold text-xs"
                        value="seguir"
                        >
                        </form>
                    @endif
                @endif
               @endauth
            </div>
            

            </p>
        </div>


    </div>
    <x-listar-post :posts="$posts"/>
@endsection