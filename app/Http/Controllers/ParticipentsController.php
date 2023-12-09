<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $participants = Participant::with('user', 'room')->get();
        return view("admin.participants.index", compact("participants"));
    }

    public function destroy($id)
    {
        //
        $participant = Participant::find($id);
        $participant->delete();
        if (Message::where("user_id", $participant->user->id)->count() > 0) {
            Message::where("user_id", $participant->user->id)->delete();
        }
        notify()->success("Participant Deleted Successfuly");
        return to_route('admin.participants');
    }
}