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
    use UploadImageTrait;
    /**
     * Display the user's profile form.
     */
    public function show(Request $request, $id)
    {
        $init_room = Room::with('user', 'topic', 'participants');

        $rooms = $init_room->where('user_id', $id)->get();

        $user = User::where('uuid', $id)->first();


        if (!$user) {
            return to_route('rooms.index');
        }



        $room_count = count($rooms);
        $topics = Topic::withCount('rooms')->limit(3)->get();
        $topics_count = count(Topic::all());
        $messages = Message::with('room', 'user')->where('user_id', $id)->orderBy("created_at", "desc")->limit(3)->get();
        return view('profile.profile', compact('user', 'topics', 'topics_count', 'rooms', 'room_count', 'messages'));
    }

    public function edit(Request $request, $id)
    {
        $user = User::where('uuid', $id)->first();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, $id)
    {
        $request->validated();
        $user = User::where('uuid', $id)->first();
        $user->update($request->validated());
        // $user->name = $request->name ?? $user->name;
        // $user->email = $request->email ?? $user->email;
        // $user->description = $request->description ?? $user->description;
        $this->uploadImage($request, "photo", $user, "profile/");

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user->save();
        notify()->preset('user-updated');

        return to_route('profile.show', $request->user()->uuid)->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function delete(Request $request, $id)
    {
        $user = User::where('uuid', $id)->first();
        return view('profile.delete', compact('user'));
    }

    public function destroy(Request $request, $id): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = User::where('uuid', $id)->first();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        notify()->success("Your Account Deleted Successfully");

        return Redirect::to('/');
    }
}