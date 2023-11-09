<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomResource;
use App\Models\Room;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //


        if (isset($_GET['topic_id'])) {
            $id = $_GET['topic_id'];
            // $topic = Topic::where('id', $id)->get();
            $rooms = Room::where('topic_id', $id)->get();

            foreach ($rooms as $room) {
                $user = User::find($room->user_id);
                $topic = Topic::find($room->topic_id);
                $room['user_name'] = $user->name;
                $room['topic'] = $topic->name;
                // $results[] = ($room);
            }
            $room_count = count($rooms);
        } elseif (isset($_GET['q'])) {
            $q = $_GET['q'];
            $rooms = $this->search($q);
            $room_count = count($rooms);
        } else {
            $rooms = Room::all();

            foreach ($rooms as $room) {
                $user = User::find($room->user_id);
                $topic = Topic::find($room->topic_id);
                $room['user_name'] = $user->name;
                $room['topic'] = $topic->name;
                $results[] = ($room);
            }
            $room_count = count($rooms);
        }
        $topics = Topic::withCount('rooms')->limit(5)->get();
        $topics_count = count(Topic::all());
        return view('index', compact('rooms', 'room_count', 'topics', 'topics_count'));
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
    public function show($slug)
    {
        $room = Room::with('user', 'topic')->where('slug', $slug)->first();

        return view('rooms.room', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        //

        $room = Room::with('user', 'topic')->where('slug', $slug    )->first();

        return view('rooms.room_edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        //

        $room = Room::where('slug',$slug)->first();

        if ($room) {
            if ($room->user_id === Auth::id()) {
                $room->update([
                    'name' => $request->name ?? $room->name,
                    'description' => $request->description ?? $room->description
                ]);
                return to_route('rooms.index');
            }
        }
    }


    public function remove($slug)
    {
        $room = Room::where('slug',$slug)->first();
        return view('rooms.delete', compact('room'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        //
        $room = Room::where('slug',$slug)->first();
        if ($room) {
            if ($room->user_id === Auth::id()) {
                $room->delete();
                return to_route('rooms.index');
            }
        }
    }

    public function roomSearch($id)
    {
        $rooms = Topic::with('rooms')->where('id', $id)->get();
        $room_count = Room::count();

        return view('index', compact('rooms',));
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