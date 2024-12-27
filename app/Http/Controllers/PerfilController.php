<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        // dd('perfil de .....');
        return view('perfil.index');
    }
    public function store(Request $request){
        // dd('editando perfil');
        //modificar el request para el slug
        $request->request->add(['username'=>Str::slug($request->username)]);
        $this->validate($request,[
            // 'username'=> 'required|min:3|max:20|unique:users'
            'username'=>['required','min:3','max:20','unique:users,username,'.auth()->user()->id,'not_in:twitter,editar-perfil'],
            'email'=>['required','unique:users,email,'.auth()->user()->id,'email','max:60'],
            'password' => ['nullable', 'confirmed', 'min:6'],
        ]);
        if($request->imagen){
             // return "Desde imagen controller";
            $imagen= $request->file('imagen');

            $nombreImagen = Str::uuid().".".$imagen->extension();

            // para que se guarde en el servidor
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000,1000);

            $imagenPath = public_path('perfiles').'/'.$nombreImagen;
        
            $imagenServidor->save($imagenPath);
            }
        
        
        //guardando cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->password = $request->password ? Hash::make($request->password) : $usuario->password;
        $usuario-> imagen = $nombreImagen ?? auth()->user()->imagen ?? null; // podemos ponerle nombreimagen o dejarlo vacio
        $usuario-> save();
        
        //redireccionar
        return redirect()->route('posts.index',$usuario->username);
    }
}
