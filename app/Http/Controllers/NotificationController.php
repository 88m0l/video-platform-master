<?php

namespace App\Http\Controllers;
use App\Models\Alert;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\Request;

class NotificationController extends Controller implements HasMiddleware
{
     public static function middleware() {
        return [
            new Middleware('auth:sanctum')
        ];
    }


    public function index() {
        $latestNotifications = auth()->user()->notifications->sortByDesc('created_at')->take(4);
        $items = array_values($latestNotifications->toArray());


        $alert = Alert::where('user_id', auth()->user()->id)->first();
        $alert->alert = 0;
        $alert->save();

        return response()->json(['latestNotifications' => $items]);
    }

    public function allNotification() {
        $notifications = auth()->user()->notifications->sortByDesc('created_at');
        $title = 'جميع الإشعارات';
        return view('notifications.index', compact('notifications', 'title'));
    }
}
