<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use lluminate\Contracts\Auth\Authenticatable;
class LoginController extends Controller
{
    
    public function index()
    {
        return view('auth.login');
    }
    public function store(Request $request){
        // dd('desde store');
        // dd($request->remember);
        $this->validate($request,[
            'email'=>'required|email',
            'password' => 'required'
        ]);

        if(!auth()->attempt($request->only('email','password'),$request->remember)){// esto devolvera un true o false si el usuario esta autenticado
            return back()->with('mensaje','credenciales incorrectas');
        }else{
            //Redireccionar
        return redirect()->route('posts.index', auth()->user()->username);
        }
    }
}
