<section>
    <h2 class=" text-4xl text-center font-black my-10">Publicaciones</h2>
    @if ($posts->count())
        
    
        <div class=" grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($posts as $post )
        
            <div>
                <h1 class=" text-center font-bold text-black text-md">{{$post->titulo}}</h1>
                <a href="{{route('posts.show', ['post'=>$post,'user'=>$post-> user])}}">
                    <img src="{{ asset('uploads').'/'. $post->imagen }}" alt="Imagen del post {{$post->titulo}}">
                </a>
            </div>
        @endforeach
    

        </div>
        <div class="my-10">
            {{$posts->links()}}
        </div>
    @else
        <a class="text-gray-600 uppercase text-sm text-center font-bold"> No hay post, sigue a usuarios para ver publicaciones de ellos</a>
    @endif
</section>