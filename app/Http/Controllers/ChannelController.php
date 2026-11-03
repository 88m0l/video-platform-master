<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index() {
        $channels = User::all()->sortByDesc('created_at');
        $title = 'أحدث القنوات';
        return view('channels.index', compact('channels', 'title'));
    }

    public function search(Request $request) {
        $channels = User::where('name', 'like', "%{$request->term}%")->paginate(12);
        $title = 'عرض نتائج البحث عن' . ' ' . $request->term;
        return view('channels.index', compact('channels', 'title'));
    }

    public function adminIndex() {
        $users = User::all();
        return view('admin.channels.index', compact('users'));
    }

    public function adminUpdate(Request $request, User $user) {
        $user->user_type = $request->user_type;
        $user->save();

        session()->flash('flash_message', 'تم تعديل صلاحيات القناة بنجاح');
        return redirect(route('channels.index'));
    }

    public function adminDestroy(User $user) {
        $user->delete();

        session()->flash('flash_message', 'تم حذف القناة بنجاح');

        return redirect(route('channels.index'));
    }

    public function adminBlock(Request $request, User $user) {
        $user->user_status = 'blocked';
        $user->save();

        session()->flash('flash_message', 'تم حظر القناة بنجاح');

        return redirect(route('channels.index'));
    }


    public function blockedChannels() {
        $channels = User::where('user_status', 'blocked')->get();
        return view('admin.channels.blocked-channels', compact('channels'));
    }

    public function adminUnBlock(Request $request, User $user) {
        $user->user_status = 'active';
        $user->save();

        session('flash_message', 'تم فك حظر القناة بنجاح');

        return redirect(route('channels.blocked'));
    }

    public function allChannels() {
        $channels = User::all()->sortByDesc('created_at');
        return view('admin.channels.all', compact('channels'));
    }
}
