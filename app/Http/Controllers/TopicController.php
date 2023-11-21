<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    private $topic_instance;
    public function __construct()
    {
        $this->topic_instance = Topic::getTopicInstance();
    }
    //

    public function index()
    {
        //
        $topics = $this->topic_instance->withCount('rooms')->get();
        $topics_count = count($topics);

        return view('topics.topics', compact('topics', 'topics_count'));
    }
}