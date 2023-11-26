<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TopicController;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/profile/{id}/delete', [ProfileController::class, 'delete'])->name('profile.delete');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [HomeController::class, 'redirect']);
    Route::get('rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('rooms/', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('rooms/{slug}', [RoomController::class, 'show'])->name('rooms.show');


    Route::get('topics/', [TopicController::class, 'index'])->name('topics.index');

    Route::get('topics/{id}/rooms', [RoomController::class, 'roomSearch'])->name('topics.rooms');


    Route::get('rooms/edit/{slug}', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('rooms/{slug}', [RoomController::class, 'update'])->name('rooms.update');


    Route::get('rooms/remove/{slug}', [RoomController::class, 'remove'])->name('rooms.remove');
    Route::post('rooms/delete/{slug}', [RoomController::class, 'destroy'])->name('rooms.delete');

    Route::post('messages/{slug}', [MessageController::class, 'store'])->name('message.store');
    Route::post('messages/delete/{id}', [MessageController::class, 'destroy'])->name('message.destroy');
});





require __DIR__ . '/auth.php';