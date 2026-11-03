<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Video;

class LikeController extends Controller implements HasMiddleware
{
    public static function middleware() {
        return [
            new Middleware('auth:sanctum')
        ];
    }


    public function likeVideo(Request $request) {

        $videoId = $request->videoId;
        $isLike = $request->isLike === 'true';

        $update = false;


        $video = Video::find($videoId);

        if (!$video) {
            return null;
        }


        $user = Auth::user();
        $like = $user->likes()->where('video_id', $videoId)->first();

        if ($like) {
            $alreadyLike = $like->like;
            $update = true;

            if ($alreadyLike == $isLike) {
                $like->delete();
            }
        }else {
            $like = new Like();
        }

        $like->like = $isLike;
        $like->user_id = $user->id;
        $like->video_id = $video->id;

        if ($update) {
            $like->update();
        }else {
            $like->save();
        }

        $countLike = Like::where('video_id', $video->id)->where('like', '1')->count();
        $countDislike = Like::where('video_id', $video->id)->where('like', '0')->count();


        return response()->json(['countLike' => $countLike, 'countDislike' => $countDislike]);
    }
}
