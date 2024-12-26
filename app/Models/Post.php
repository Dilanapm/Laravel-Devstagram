<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];
    // un post va a tener un usuario
    public function user(){
        // forma inversa de relacion (relacion inversa)
        return $this->belongsTo(User::class)->select((['name','username']));
    }

    // un post va a tener multiples comentarios
    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user){
        // esto lo que hace es posicionarse en la tabla de likes y utilizando contains, se pregunta si contiene este usuario 
        // busca si existe un registro que contenga el mismo usuario y post 
        return $this->likes->contains('user_id',$user->id);
    }
}
