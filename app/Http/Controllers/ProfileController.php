<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Topic;
use App\Models\Room;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show(Request $request,$id)
    {
        $topics = Topic::withCount('rooms')->get();
        $topics_count = count($topics);
        $user = User::find($id);
        if(!$user){
            return to_route('rooms.index');
        }
        $rooms = Room::where('user_id',$user->id)->get();
        foreach($rooms as $room){
            $room['topic'] = Topic::find($room->topic_id)->name;
        }
        $room_count = count($rooms);
        return view('profile.profile',compact('user','topics','topics_count','rooms','room_count'));
    }

    public function edit(Request $request){
        $user = $request->user();
        return view('profile.edit',compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function delete(Request $request){
        $user = $request->user();
        return view('profile.delete',compact('user'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}