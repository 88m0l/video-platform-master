<?php

namespace App\Http\Controllers;

use App\Jobs\ConvertVideoForStreaming;
use App\Models\Convertedvideo;
use App\Models\View;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Storage;
use App\Models\Video;
use App\Models\Like;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = auth()->user()->videos->sortByDesc('created_at');
        $title = "آخر الفيديوهات المرفوعة";
        return view('videos.my-videos', compact('videos', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('videos.uploader');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = auth()->user()->id;

        $request->validate([
            'title' => 'required',
            'image' => 'image|required',
            'video' => 'required'
        ]);


        $randomPath = Str::random(16);
        $videoPath = $randomPath . '.' . $request->video->getClientOriginalExtension();
        $imagePath = $randomPath . '.' . $request->image->getClientOriginalExtension();

        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->image)->resize(320, 180);

        Storage::put($imagePath, $image->toJpeg());

        $request->video->storeAs('/', $videoPath, 'public');

        $video = Video::create([
            'disk' => 'public',
            'video_path' => $videoPath,
            'image_path' => $imagePath,
            'title' => $request->title,
            'user_id' => $userId
        ]);



        View::create([
            'video_id' => $video->id,
            'user_id' => $userId,
            'views_number' => 0
        ]);


        ConvertVideoForStreaming::dispatch($video);

        return redirect('/videos/create')
                ->with('success', 'سيكون مقطع الفيديو متوفر في أقصر وقت عندما ننتهي من معالجته');

    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        $countLike = Like::where('video_id', $video->id)->where('like', '1')->count();
        $countDislike = Like::where('video_id', $video->id)->where('like', '0')->count();

        $user = Auth::user();
        
        if (Auth::check()) {
            $userLike = $user->likes()->where('video_id', $video->id)->first();
        }else {
            $userLike = 0;
        }


        if (Auth::check()) {
            $user->videoInHistory()->attach($video->id);
        }


        $comments = $video->comments->sortByDesc('created_at');


        return view('videos.show-video', compact('video','countLike', 'countDislike', 'userLike', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $video = Video::where('id', $id)->first();
        return view('videos.edit-video', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'title' => 'required'
            ]
        );

        $video = Video::where('id', $id)->first();


        if ($request->has('image')) {
            $randomPath = Str::random(16);
            $newPath = $randomPath . '.' . $request->image->getClientOriginalExtension();

            Storage::delete($video->image_path);

            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->image)->resize(320, 180);

            Storage::put($newPath, $image->toJpeg());

            $video->image_path = $newPath;
        }


        $video->title = $request->title;

        $video->save();

        return redirect('/videos')->with('success', 'تم تعديل معلومات الفيديو بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $video = Video::where('id', $id)->first();
        $convertedVideos = Convertedvideo::where('video_id', $id)->get();

        foreach($convertedVideos as $convertedVideo) {
            Storage::delete([
                $convertedVideo->mp4_Format_240,
                $convertedVideo->mp4_Format_360,
                $convertedVideo->mp4_Format_480,
                $convertedVideo->mp4_Format_720,
                $convertedVideo->mp4_Format_1080,
                $convertedVideo->webm_Format_240,
                $convertedVideo->webm_Format_360,
                $convertedVideo->webm_Format_480,
                $convertedVideo->webm_Format_720,
                $convertedVideo->webm_Format_1080,
                $video->image_path
            ]);
        }

        $video->delete();

        return back()->with('success', 'تم حذف مقطع الفيديو بنجاح');
    }

    public function search(Request $request) 
    {
        $videos = Video::where('title', 'like', "%{$request->term}%")->paginate(12);
        $title = 'عرض نتائج البحث عن'. ' ' . $request->term;
        return view('videos.my-videos', compact('videos', 'title'));
    }

    public function addView(Request $request) {
        $views = View::where('video_id', $request->videoId)->first();

        $views->views_number++;

        $views->save();

        $viewsNumbers = $views->views_number;

        return response()->json(['viewsNumbers' => $viewsNumbers]);
    }

    public function mostViewsVideos() {
        $mostViewsVideos = View::orderBy('views_number', 'Desc')
        ->take(10)
        ->get(['user_id', 'video_id', 'views_number']);

        $videoNames = [];
        $videoViews = [];

        foreach($mostViewsVideos as $view) {
            array_push($videoNames, Video::find($view->video_id)->title);
            array_push($videoViews, $view->views_number);
        }



        return view('admin.mostViewsVideos', compact('mostViewsVideos'))
        ->with('videoNames', json_encode($videoNames, JSON_NUMERIC_CHECK))
        ->with('videoViews', json_encode($videoViews, JSON_NUMERIC_CHECK));
    }
}
