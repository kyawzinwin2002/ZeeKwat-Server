<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\CreatePostRequest;
use App\Http\Requests\Api\Post\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id)->get();

        return $this->successResponse('', 200, $posts);
    }

    public function show(Post $post)
    {
        $post = Post::where('user_id', auth()->user()->id)
            ->where('id', $post->id)
            ->get();

        return $this->successResponse('', 200, $post);
    }

    public function create(CreatePostRequest $request)
    {
        $post = auth()->user()->posts()->create([
            'text' => $request->text
        ]);

        if($request->image_path){
            $post->photo()->create([
                'image_path' => $request->image_path
            ]);
        }

        if($request->video_path){
            $post->photo()->create([
                'video_path' => $request->video_path
            ]);
        }

        return $this->successResponse('created successfully', 201, $post);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        if($request->image_path){
            $post->photo()->update([
                'image_path' => $request->image_path
            ]);
        }

        if($request->video_path){
            $post->photo()->update([
                'video_path' => $request->video_path
            ]);
        }

        return $this->successResponse('created successfully', 200, $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return $this->successResponse('deleted successfully', 204);
    }
}
