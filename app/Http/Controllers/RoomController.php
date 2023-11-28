<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Message;
use App\Models\Participant;
use App\Models\Room;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RoomController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $init_room = Room::with('user', 'topic', 'participants');
        if ($request->has('topic_id')) {
            $id = $request->query('topic_id');
            $rooms = $init_room->where('topic_id', $id)->get();

        } elseif ($request->has('q')) {
            $q = $request->query('q');
            $rooms = $this->search($q);
        } else {
            $rooms = $init_room->get();
        }

        $room_count = count($rooms);
        $topics = Topic::withCount('rooms')->limit(3)->get();
        $topics_count = count(Topic::all());
        $messages = Message::with('room', 'user')->orderBy("created_at", "desc")->limit(3)->get();
        return view('index', compact('rooms', 'room_count', 'topics', 'topics_count', "messages"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $topics = Topic::all();
        return view('rooms.room_form', compact('topics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request)
    {
        //
        $user = User::find(Auth::id());
        $topic = Topic::where('name', $request->topic)->first();
        if ($user) {
            $user->rooms()->create([
                'name' => $request->room_name,
                'description' => $request->description,
                'topic_id' => $topic->id
            ]);
            notify()->success('Room Created Successfully');
            return to_route('rooms.index');
        } else {
            return to_route('login');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $slug)
    {

        $room = Room::with('user', 'topic', 'messages', 'participants')
            ->where('slug', $slug)->first();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $room->messages()->create([
                'message' => $request->message
            ]);
            return to_route('rooms.show', $room->slug);
        }

        return view('rooms.room', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        //


        $room = Room::with('user', 'topic')->where('slug', $slug)->first();
        if (Gate::allows('update', $room)) {
            return view('rooms.room_edit', compact('room'));
        } else {
            return to_route('rooms.show', ['slug' => $room->slug]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        //

        $room = Room::where('slug', $slug)->first();

        if ($room) {
            if (Gate::allows('update', $room)) {
                $room->update([
                    'name' => $request->name ?? $room->name,
                    'description' => $request->description ?? $room->description
                ]);
                notify()->success('Room Updated Successfully');
                return to_route('rooms.show', $room->slug);
            } else {
                return to_route('rooms.index');
            }
        }
    }


    public function remove($slug)
    {
        $room = Room::where('slug', $slug)->first();
        if (Gate::allows('update', $room)) {
            return view('rooms.delete', compact('room'));
        } else {
            return to_route('rooms.show', ['slug' => $room->slug]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        //
        $room = Room::where('slug', $slug)->first();
        if ($room) {
            if ($room->user_id === Auth::id()) {

            }
        }
        if ($room) {
            if (Gate::allows('delete', $room)) {
                $room->delete();
                notify()->success('Room Deleted Successfully');
                return to_route('rooms.index');
            } else {
                return to_route('rooms.show', ['slug' => $room->slug]);
            }
        }
    }
    public function search($q)
    {
        $results = Room::with('user', 'topic', 'participants')->where('name', 'LIKE', "%$q%")->get();
        $rooms = RoomResource::collection($results);
        return $rooms;
    }
}