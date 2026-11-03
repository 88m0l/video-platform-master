<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use App\Models\View;
use DB;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function index() {
        $numberOfVideos = Video::count();
        $numberOfChannels = User::count();

        $mostVideos = View::select('user_id', DB::raw('sum(views.views_number) as total'))
            ->groupBy('user_id')
            ->orderBy('total', 'Desc')
            ->take(5)
            ->get();

        $names = [];
        $totalViews = [];

        foreach($mostVideos as $view) {
            array_push($names, User::find($view->user_id)->name);
            array_push($totalViews, $view->total);
        }

        return view('admin.index', compact('numberOfVideos', 'numberOfChannels'))
            ->with('names', json_encode($names, JSON_NUMERIC_CHECK))
            ->with('totalViews', json_encode($totalViews, JSON_NUMERIC_CHECK));
    }
}
