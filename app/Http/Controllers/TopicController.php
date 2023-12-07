<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    //

    public function index()
    {
        //
        $topics = Topic::withCount('rooms')->get();
        return view('topics.topics', compact('topics'));
    }
    public function topics()
    {
        //
        $topics = Topic::all();
        $topics_count = Topic::count();
        return view('admin.topics.index', compact('topics', 'topics_count'));
    }

    public function create()
    {
        return view('admin.topics.create');
    }

    public function store(TopicRequest $request)
    {
        $user = auth()->user();
        $user->topics()->create([
            'name' => $request->name,
        ]);
        return to_route('admin.topics');
    }

    public function destroy($id)
    {
        $topic = Topic::find($id);
        $topic->delete();
        return to_route('admin.topics');
    }
}