<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comentario;
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
    
}
