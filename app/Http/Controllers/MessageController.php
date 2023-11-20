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
    public function index($slug)
    {
        $room = Room::where('slug', $slug)->get();
        $messages = Message::where('room_id', $room->id)->get();
        return view('rooms.room', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        if ($message) {
            if (!$user->participants()->exists()) {
                $room->participants()->attach($user->id);
            }
        }
        return to_route('rooms.show', $room->slug);
    }
    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
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