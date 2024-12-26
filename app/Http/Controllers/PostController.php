<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['show', 'index']); //un middleware se ejecuta un poco antes de ejecutar el index para ver si el usuario esta autenticado
    }
    public function index(User $user){
        // dd('desde muro');
        // dd($user->username);

        $posts = Post::where('user_id',$user->id)->paginate(10);


        return view('dashboard',[
            'user'=> $user,
            'posts'=> $posts
        ]);
    }
    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        // dd('creando publicacion');
        $this->validate($request,[
            'titulo'=> 'required|max:60',
            'descripcion'=>'required',
            'imagen' => 'required',

        ]);
        // Post::create([
        //     'titulo' => $request -> titulo,
        //     'descripcion' => $request -> descripcion,
        //     'imagen' => $request -> imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        // registrar con la relaciones, tambien se puede utilizar el de arriba con las relaciones
        $request->user()->posts()->create([
            'titulo' => $request -> titulo,
            'descripcion' => $request -> descripcion,
            'imagen' => $request -> imagen,
            'user_id' => auth()->user()->id 
        ]);
        return redirect()->route('posts.index', auth()->user()->username);
        }
    
    

    public function show( User $user,Post $post){
        return view('posts.show',[
            'post' => $post,
            'user' => $user
            
        ]);
        
    }
    public function destroy(Post $post){
        // dd('eliminando ', $post->id);
        // if($post -> user_id === auth()->user()->id){
        //     dd('si es la misma persona');
        // }else{
        //     dd('no es la misma persona');
        // }
        $this->authorize('delete', $post);
        $post->delete();
        // eliminar imagen
        $imagen_path = public_path('uploads/'.$post->imagen);
        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }
        
        
        return redirect()->route('posts.index',auth()->user()->username);
    }
}
