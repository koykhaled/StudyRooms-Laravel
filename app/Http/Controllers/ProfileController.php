<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Message;
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
    public function show(Request $request, $id)
    {
        $init_room = Room::with('user', 'topic', 'participants');

        $rooms = $init_room->where('user_id', $id)->get();

        $user = User::find($id);



        $room_count = count($rooms);
        $topics = Topic::withCount('rooms')->limit(3)->get();
        $topics_count = count(Topic::all());
        $messages = Message::with('room', 'user')->where('user_id', $id)->orderBy("created_at", "desc")->limit(3)->get();
        return view('profile.profile', compact('user', 'topics', 'topics_count', 'rooms', 'room_count', 'messages'));
    }

    public function edit(Request $request)
    {
        $user = $request->user();
        return view('profile.edit', compact('user'));
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
    public function delete(Request $request)
    {
        $user = $request->user();
        return view('profile.delete', compact('user'));
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