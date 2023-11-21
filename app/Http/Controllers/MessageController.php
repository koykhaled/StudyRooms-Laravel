<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::with('room', 'user')->orderBy("created_at", "desc")->limit(5)->get();
        return view("rooms.active_component", compact("messages"));

    }


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

        if (!$room->participants()->exists($user->id)) {
            $room->participants()->attach($user->id);
        }
        return to_route('rooms.show', $room->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $message = Message::where('id', $id)->first();
        $room = Room::where('id', $message->room_id)->first();
        $message->delete();
        return to_route('rooms.show', $room->slug);

    }
}