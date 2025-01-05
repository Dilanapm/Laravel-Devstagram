<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isliked;
    public $likes;
    public function mount($post){
        $this->isliked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }
    public function like(){

        if($this->post->checkLike(auth()->user() )){ // el checklike esta en el modelo de post
            // dd('eliminando like');
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isliked = false;
            $this->likes--;
            
        }else{
            // dd('dando like');
            $this->post->likes()->create([
            'user_id' => auth()->user()->id
            
        ]);
        $this->isliked = true;
        $this->likes++;
        }

        // return "desde la funcion de like";
    }
     // esto estara disponible desde la vista tambien
    public function render()
    {
        return view('livewire.like-post');
    }
}
