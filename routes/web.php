<?php

use App\Http\Controllers\CharacterMatchController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Task routes
    Route::resource('task', TaskController::class)->except(['show']);
    Route::get('/task/analyze', [TaskController::class, 'analyze'])->name('task.analyze');

    // Character match routes
    Route::get('/character-match', [CharacterMatchController::class, 'index'])->name('character-match.index');
    Route::post('/character-match/process', [CharacterMatchController::class, 'process'])->name('character-match.process');
    Route::get('/character-match/result/{characterMatch}', [CharacterMatchController::class, 'result'])->name('character-match.result');
    Route::get('/character-match/list', [CharacterMatchController::class, 'list'])->name('character-match.list');
    Route::delete('/character-match/{characterMatch}', [CharacterMatchController::class, 'destroy'])->name('character-match.destroy');
});
