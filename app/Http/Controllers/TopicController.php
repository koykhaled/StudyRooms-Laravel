<?php

namespace App\Http\Controllers;

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
}