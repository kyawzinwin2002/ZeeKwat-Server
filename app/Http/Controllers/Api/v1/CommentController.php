<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Comment\CreateCommentRequest;
use App\Http\Requests\Api\Comment\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        $comments = Comment::where('user_id', auth()->user()->id)
            ->where('post_id', $post->id)
            ->get();

        return $this->successResponse('', 200, $comments);
    }

    public function show(Comment $comment)
    {
        $comment = comment::where('user_id', auth()->user()->id)
            ->where('id', $comment->id)
            ->get();

        return $this->successResponse('', 200, $comment);
    }

    public function create(CreateCommentRequest $request)
    {
        $comment = auth()->user()->comments()->create([
            'text' => $request->text
        ]);

        if($request->image_path){
            $comment->photo()->create([
                'image_path' => $request->image_path
            ]);
        }

        if($request->video_path){
            $comment->video()->create([
                'video_path' => $request->video_path
            ]);
        }

        return $this->successResponse('created successfully', 201, $comment);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        if($request->image_path){
            $comment->photo()->update([
                'image_path' => $request->image_path
            ]);
        }

        if($request->video_path){
            $comment->video()->update([
                'video_path' => $request->video_path
            ]);
        }

        return $this->successResponse('created successfully', 200, $comment);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return $this->successResponse('deleted successfully', 204);
    }
}
