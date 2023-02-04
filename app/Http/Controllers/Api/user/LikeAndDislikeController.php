<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\post;
use Illuminate\Http\Request;

class LikeAndDislikeController extends Controller
{
    public function CountLikeAndDislike($id)
    {
        $postLikeCount = Like::where('post_id', $id)->where('liked', true)->count();
        $postDislikeCount = Like::where('post_id', $id)->where('liked', false)->count();
        return response()->json(['likedCount' => $postLikeCount, 'dislikedCount' => $postDislikeCount], 200);
    }

    public function liked(Request $request)
    {
        $post = Post::findOrFail($request->post_id);
        $post->liked($request->user_id);
        return response()->json(['message' => "پست با موفقیت لایک شد"], 200);
    }

    public function dislike(Request $request)
    {
        $post = Post::findOrFail($request->post_id);
        $post->dislike($request->user_id);
        return response()->json(['message' => "پست با موفقیت دیس لایک شد"], 200);
    }
}
