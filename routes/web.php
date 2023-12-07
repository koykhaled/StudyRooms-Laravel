<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
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



Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'redirect'])->name('/');

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
        Route::get('', [RoomController::class, 'index'])->name('rooms.index');
        Route::get('/create', [RoomController::class, 'create'])->name('rooms.create')->middleware('check_admin');
        Route::post('/', [RoomController::class, 'store'])->name('rooms.store');
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


    Route::group(['prefix' => 'dashboard', 'middleware' => ['check_admin']], function () {
        Route::get('', [HomeController::class, 'dashboard'])->name('dashboard');


        Route::group(['prefix' => 'topics'], function () {
            Route::get('', [TopicController::class, 'topics'])->name('admin.topics');
            Route::get('/create', [TopicController::class, 'create'])->name('admin.topics.create');
            Route::post('', [TopicController::class, 'store'])->name('admin.topics.store');
            Route::delete('/{id}', [TopicController::class, 'destroy'])->name('admin.topics.delete');
        });


        Route::group(['prefix' => 'users'], function () {
            Route::get('', [UserController::class, 'index'])->name('admin.users');

            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
            Route::put('/{id}', [UserController::class, 'update'])->name('admin.users.update');

            Route::delete('/{id}', [UserController::class, 'destroy'])->name('admin.users.delete');
        });
    });

});













require __DIR__ . '/auth.php';