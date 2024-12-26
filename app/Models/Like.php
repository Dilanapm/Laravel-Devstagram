<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id'
        // 'post_id' ya no requerimos el post id porque ya tiene una relacion en post.php en models con la funcion likes()
    ];
}
