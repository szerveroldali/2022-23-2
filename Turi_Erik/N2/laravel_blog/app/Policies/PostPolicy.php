<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Post $post){
        return $user -> is_admin || $post -> author_id === $user -> id;
    }

    public function create(){
        return Auth::check();
    }
}
