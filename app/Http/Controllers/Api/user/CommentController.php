<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCommentRequest;
use App\Http\Requests\ProjectCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Project;
use function PHPUnit\Framework\isNull;

class CommentController extends Controller
{
    public function AddCommentToPost(PostCommentRequest $request)
    {
        $post = Post::findOrFail($request->post_id);
        $checkComment = Comment::where("user_id", $request->user_id)->where("commentable_id", $post->id)->get();
        if (!isNull($checkComment)) {
            return response()->json(["message" => "شما قبلا  برای این پست کامنت گذاشتید"], 200);
        }
        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->admin_id = $request->admin_id;
        $comment->parent_id = $request->parent_id;
        $comment->comment = $request->comment;
        $comment->status = "pending";
        $post->comments()->save($comment);
        return response()->json(["message" => "کامنت با موفقیت ثبت شد در انتظار تایید"], 200);
    }

    public function getPostComments($id)
    {
        $comments = Comment::where('commentable_id', $id)->where('commentable_type', 'App\Models\post')->with(["replies.user", "replies.admin", "user", "admin"])->get();
        $postCommentsCount = Comment::where('commentable_id', $id)->where('commentable_type', 'App\Models\post')->count();
        return response()->json(["comments" => $comments, "commentCount" => $postCommentsCount], 200);
    }

    public function AddCommentToProject(ProjectCommentRequest $request)
    {
        $project = Project::findOrFail($request->project_id);
        $checkComment = Comment::where("user_id", $request->user_id)->where("commentable_id", $project->id)->get();
        if (!isNull($checkComment)) {
            return response()->json(["message" => "شما قبلا  برای این پروژه کامنت گذاشتید"], 200);
        }
        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->admin_id = $request->admin_id;
        $comment->parent_id = $request->parent_id;
        $comment->comment = $request->comment;
        $comment->status = "pending";
        $project->comments()->save($comment);
        return response()->json(["message" => "کامنت با موفقیت ثبت شد در انتظار تایید"], 200);
    }

    public function getProjectComments($id)
    {
        $comments = Comment::where('commentable_id', $id)->where('commentable_type', 'App\Models\Project')->with(["replies.user", "replies.admin", "user", "admin"])->get();
        return response()->json(["comments" => $comments], 200);
    }
}
