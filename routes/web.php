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


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
|
| Here is where you can manage user profile by update , show and delete user profile
*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'redirect']);

    /*
    |--------------------------------------------------------------------------
    | Profile Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can manage user profile by update , show and delete user profile
    */

    Route::group(['prefix' => 'profile'], function () {

        Route::get('/{id}', [ProfileController::class, 'show'])->name('profile.show');

        Route::get('/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/{id}', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/{id}/delete', [ProfileController::class, 'delete'])->name('profile.delete');
        Route::delete('/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Rooms Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can manage Room by create , search ,m  update , show and delete rooms
    */

    Route::group(['prefix' => 'rooms'], function () {
        Route::get('/create', [RoomController::class, 'create'])->name('rooms.create');
        Route::post('/', [RoomController::class, 'store'])->name('rooms.store');
        Route::get('', [RoomController::class, 'index'])->name('rooms.index');
        Route::get('/{slug}', [RoomController::class, 'show'])->name('rooms.show');
        Route::get('/{slug}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/{slug}', [RoomController::class, 'update'])->name('rooms.update');


        Route::get('/remove/{slug}', [RoomController::class, 'remove'])->name('rooms.remove');
        Route::post('/delete/{slug}', [RoomController::class, 'destroy'])->name('rooms.delete');
    });

    Route::get('topics/', [TopicController::class, 'index'])->name('topics.index');


    /*
    |--------------------------------------------------------------------------
    | Messages Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can manage messages by update , show and delete messages
    */

    Route::group(['prefix' => 'messages'], function () {
        Route::post('/{slug}', [MessageController::class, 'store'])->name('message.store');
        Route::post('/{id}/delete', [MessageController::class, 'destroy'])->name('message.destroy');
    });

});













require __DIR__ . '/auth.php';