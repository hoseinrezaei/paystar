<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::select(['id', 'title', 'text']);
        dd($posts);
    }

    public function show(Request $request)
    {
        $post = Post::where('id', $request->id);
        dd($post);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required',
            'text' => 'required'
        ]);
    }

    public function update(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required',
            'text' => 'required'
        ]);
    }

    public function destroy(Request $request)
    {
        $post = Post::find($request->id);
        $post->delete();
    }

}
