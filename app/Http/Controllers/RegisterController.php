<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
// un facade en laravel son como funciones que vienen para una funcion en especificos y de ayuda para reailzar ciertas acciones
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }
    public function store(Request $request) {
        // dd($request);
        // dd($request->get('email'));

        //Modificar request
        $request -> request-> add(['username' => Str::slug($request->username)]);
        

        $this->validate($request,[
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email'=>'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        
        ]);
        // dd('creando usuario'); verificando
        // equivalente a insert into de mysql
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // autenticar usuario
        // auth()->attempt([
        //     'email' => $request -> email,
        //     'password' => $request -> password,
        // ]);

        // Otra forma de autenticar
        auth()-> attempt($request->only('email','password'));


        //Redireccionar
        return redirect()->route('posts.index', ['user' => auth()->user()->username]);
    }
}
