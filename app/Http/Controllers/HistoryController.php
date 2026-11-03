<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\Request;

class HistoryController extends Controller implements HasMiddleware
{
    public static function middleware() {
        return [
            new Middleware('auth:sanctum')
        ];
    }


    public function index() {
        $user = Auth::user();
        $videos = $user->videoInHistory()->get();
        $title = 'سجل المشاهدة';
        return view('history.index', compact('videos', 'title'));
    }

    public function destroy($id) {
        auth()->user()->videoInHistory()->wherePivot('id', $id)->detach();
        return back()->with('success', 'تم حذف مقطع الفيديو بنجاح من سجل المشاهدة');
    }


    public function destroyAll() {
        auth()->user()->videoInHistory()->detach();
        return back()->with('success', 'تم حذف جميع محتويات السجل');
    }
}
