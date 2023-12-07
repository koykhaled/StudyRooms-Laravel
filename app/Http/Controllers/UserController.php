<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'user')->get();
        $users_count = User::where('role', 'user')->count();
        return view('admin.users.index', compact('users', 'users_count'));
    }

    /**
     * Show the form for editing user role.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->role = $request->input('role');
        $user->save();
        notify()->success('user updated successfuly');
        return to_route('admin.users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::find($id);
        $user->delete();
        notify()->success('User Deleted Successfuly');
        return to_route('admin.users');
    }
}