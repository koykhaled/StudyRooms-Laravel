<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Participant;
use App\Models\Room;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    public function redirect(Request $request)
    {
        if (auth()->user()->hasRole()) {
            return to_route('dashboard');
        }
        return to_route('rooms.index');
    }

    public function dashboard()
    {
        $rooms = Room::count();
        $users = User::where('role', 'user')->count();
        $messages = Message::count();
        $topics = Topic::count();
        $participants = Participant::count();
        return view('admin.index', compact('rooms', 'users', 'messages', 'topics', 'participants'));
    }
}