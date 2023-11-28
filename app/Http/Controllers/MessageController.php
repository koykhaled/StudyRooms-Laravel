<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $slug)
    {
        $user = auth()->user();
        $room = Room::where('slug', $slug)->first();
        $message = $user->messages()->create([
            'message' => $request->message,
            'room_id' => $room->id,
        ]);

        if (!$room->participants()->where('user_id', $user->id)->exists()) {
            $room->participants()->attach($user->id);
        }
        return to_route('rooms.show', $room->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $message = Message::where('id', $id)->first();
        $room = Room::where('id', $message->room_id)->first();
        $message->delete();
        if (!Message::where('user_id', $user->id)->exists()) {
            $room->participants()->detach($user->id);
        }
        return to_route('rooms.show', $room->slug);

    }
}