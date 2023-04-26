<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlayerController;

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
})->name('welcome');

Route::resource('games', GameController::class);
Route::resource('events', EventController::class, ['only' => ['store', 'destroy']]);
Route::resource('teams', TeamController::class, ['except' => ['destory']]);
Route::resource('players', PlayerController::class, ['only' => ['store', 'destroy']]);

Route::post('games/{game}/close', [GameController::class, 'close'])->name('games.close');
Route::get('/table', [TeamController::class, 'table'])->name('table');
Route::get('/favourites', [GameController::class, 'favourites'])
 ->middleware('auth')->name('favourites');
Route::post('/addfav/{team}', [ProfileController::class ,'addFav'])->name('addfav');
Route::post('/delfav/{team}', [ProfileController::class ,'delFav'])->name('delfav');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
