<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json(['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                "title"=>'required',
                "content"=>"required"
            ]
            );

        if($validator->fails()){

            return response()->json([
                "Validator error"=>$validator->errors()
            ]);
        }

        $post= Post::create([
            'title'=>$input['title'],
            'content'=>$input['content']
        ]);

        return response()->json(
            [
                'message'=>"post created successfully",
                "post"=> $post
            ]
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // Verify if post exists 
        $post = Post::find($id);

        // if not 
        if(is_null($post)){

            return response()->json(
                [
                    "error"=> "Post not found"
                ]
                );
        }

        // if post exists
        // check if request contains title and content

        $input = $request->all();

        $validator = Validator::make(
            $input,
            [
                "title"=>"required",
                "content"=>"required"
            ]
            );


        // if validator fails
        if($validator->fails()){

            return response()->json(
                [
                    "error"=>$validator->errors()
                ]
                );
        }


        // update the post

        $post->title=$input['title'];
        $post->content=$input['content'];
        $post->save();

        return response()->json(

            [
                "message"=>" Post updated successfully"
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // check if the post exists

        $post = Post::find($id);

        if(is_null($post)){

            return response()->json(
                [
                    "error"=> "Post not found"
                ]
                );
        }


        $post->delete();

        return response()->json(

            ['message'=>"Post deleted successfully"]
        );
    }
}
