<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    // Create a new post
    public function createPost(array $data)
    {
        return Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => Auth::id(),
        ]);
    }

    // Get all posts for the authenticated users
    public function getPosts($limit = 10)
    {
        return Post::paginate($limit);
    }

    // Get a single post by ID
    public function getPostById($id)
    {
        return Post::where('id', $id)->first();
    }

    // Update a post
    public function updatePost($id, array $data)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();

        if ($post) {
            $post->update([
                'title' => $data['title'],
                'content' => $data['content'],
            ]);
        }

        return $post;
    }

    // Delete a post
    public function deletePost($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();

        if ($post) {
            $post->delete();
        }

        return $post;
    }
}
