<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::select(['id', 'title', 'text'])->paginate(10);

        return response()->json([
            'posts' => $posts
        ],200);
    }

    public function show(Request $request)
    {
        $post = Post::find($request->id);
        return response()->json([
            'post' => $post
        ],200);
    }

    /**
     * Store a new blog post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated =Validator::make($request->json()->all(),[
            'text' => 'required',
            'title' => 'required',
        ]) ;


        if ($validated->fails())
        {
            return response()->json([
                'status'   => 'Bad parameters',
                'errors' => $validated->errors()->all()
            ], 400);
        }

        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->text = $request->text;
        $post->save();


        return response()->json([
            'status' => "successfully",
            'post_id' => $post->id
        ], 200);

    }

    public function update(Request $request)
    {
        $validated =Validator::make($request->json()->all(),[
            'text' => 'required',
            'title' => 'required',
        ]) ;


        if ($validated->fails())
        {
            return response()->json([
                'status'   => 'Bad parameters',
                'errors' => $validated->errors()->all()
            ], 400);
        }
        $post = Post::find($request->id);


        if (Auth::id() == $post->user_id)
        {
            $post->title = $request->title;
            $post->text = $request->text;
            $post->save();

            return response()->json([
                'status' => "successfully",
                'post_id' => $post->id
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => "you are not access",
            ], 403);
        }
    }

    public function destroy(Request $request)
    {

        $post = Post::find($request->id);

        if (Auth::id() == $post->user_id)
        {
            $post->delete();

            return response()->json([
                'status' => "successfully",
                'post_id' => $post->id
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => "you are not access",
            ], 403);
        }


    }

}
