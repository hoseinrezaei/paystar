<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::select(['id', 'title', 'text']);

        return response()->json([
            'posts' => $posts
        ],200);
    }

    public function show(Request $request)
    {
        $post = Post::where('id', $request->id);
        dd($post);
    }

    public function store(Request $request)
    {
        dd($request);
        $validation = $request->validate([
            'user_id' => 'required|integer',
            'title' => 'required',
            'text' => 'required',
        ]);

        if ($validation->fails())
        {
            return response()->json([
                'error'   => 'there is a problem',
                'Message' => $validation->errors()->all()
            ], 400);
        }

        $user = User::find($request->user_id);

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
