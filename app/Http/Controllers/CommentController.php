<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Auth;
use Carbon\Carbon;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\Request;
use App\Models\Video;

class CommentController extends Controller implements HasMiddleware
{
    public static function middleware() {
        return [
            new Middleware('auth:sanctum')
        ];
    }


    public function store(Request $request) {
        $videoId = $request->videoId;
        $userComment = $request->comment;


        $video = Video::find($videoId);

        if (!$video) {
            return null;
        }


        $comment = new Comment();
        $user = Auth::user();

        $comment->body = $userComment;
        $comment->user_id = $user->id;
        $comment->video_id = $videoId;

        $comment->save();


        $userName = $user->name;
        $userImage = $user->profile_photo_url;
        $commentDate = Carbon::now()->diffForHumans();
        $commentId = $comment->id;

        return response()->json(['username' => $userName, 'commentDate' => $commentDate, 'userImage' =>$userImage, 'commentId' => $commentId]);

    }


    public function edit($id) {
        $comment = Comment::where('id', $id)->first();
        return view('comments.edit-comment', compact('comment'));
    }

    public function destroy($id) {
        $comment = Comment::where('id', $id)->first();

        $comment->delete();

        return back()->with('success', 'تم حذف التعليق بنجاح');
    }


    public function update(Request $request, $id) {
        $request->validate([
            'comment' => 'required'
        ]);

        $comment = Comment::where('id', $id)->first();
        $videoId = $comment->video->id;

        $comment->body = $request->comment;

        $comment->save();


        return redirect('videos/' . $videoId )->with('success', 'تم تعديل محتوى التعليق بنجاح');
    }
}
