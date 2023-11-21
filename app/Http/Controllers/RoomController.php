<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        if (isset($_GET['topic_id'])) {
            $id = $_GET['topic_id'];
            $rooms = Room::where('topic_id', $id)->get();

        } elseif (isset($_GET['q'])) {
            $q = $_GET['q'];
            $rooms = $this->search($q);
            $room_count = count($rooms);
        } else {
            $rooms = Room::all();
        }

        foreach ($rooms as $room) {
            $user = User::find($room->user_id);
            $topic = Topic::find($room->topic_id);
            $room['user_name'] = $user->name;
            $room['topic'] = $topic->name;
        }
        $room_count = count($rooms);
        $topics = Topic::withCount('rooms')->limit(5)->get();
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
    public function store(Request $request)
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
                return to_route('rooms.index');
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
                return to_route('rooms.index');
            } else {
                return to_route('rooms.show', ['slug' => $room->slug]);
            }
        }
    }

    public function roomSearch($id)
    {
        $rooms = Topic::with('rooms')->where('id', $id)->get();
        $room_count = Room::count();

        return view('index', compact('rooms', ));
    }

    public function search($q)
    {

        $rooms = Room::where('name', 'LIKE', "%$q%")->get();
        foreach ($rooms as $room) {
            $user = User::find($room->user_id);
            $topic = Topic::find($room->topic_id);
            $room['user_name'] = $user->name;
            $room['topic'] = $topic->name;
            $results[] = ($room);
        }
        $rooms = RoomResource::collection($results);
        return $rooms;
    }
}