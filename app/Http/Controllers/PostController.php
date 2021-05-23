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
        //some code
    }

    public function store(Request $request)
    {
        //some code
    }

    public function update(Request $request)
    {
        //some code
    }

    public function destroy(Request $request)
    {
        //some code
    }
    
}
