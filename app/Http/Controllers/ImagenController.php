<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image; // una facade proporciona una forma amigable y práctica de usar servicios en Laravel

class ImagenController extends Controller
{
    //
    public function store(Request $request){
        // return "Desde imagen controller";
        $imagen= $request->file('file');

        $nombreImagen = Str::uuid().".".$imagen->extension();

        // para que se guarde en el servidor
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000,1000);

        $imagenPath = public_path('uploads').'/'.$nombreImagen;
        
        $imagenServidor->save($imagenPath);
        return response()->json(['imagen'=> $nombreImagen]); // nos retorna todo el request
    }
}
