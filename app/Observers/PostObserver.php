<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    /**
     * Handle the Post "creating" event.
     */
    public function creating(Post $post): void
    {
        // Nesse exemplo pode pegar usuário autenticado e recuperar o id
        // para antes de criar um registro sempre utilizar o usuário logado
        // $post->user_id = auth()->user()
        $post->user_id = '1';
    }
}
