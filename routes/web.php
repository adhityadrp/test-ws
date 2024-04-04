<?php

use App\Events\RealTimeMessage;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    $user = Auth::id();
    
    return view('welcome', compact(['user']));
});

Route::get('/dashboard', function () {
    $user = User::whereNot('id', Auth::id())->get();
    $self = User::find(Auth::id());
    // dd($user);
    return view('dashboard', compact(['user', 'self']));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('note', NoteController::class);
route::get('/event', function() {
    event(new RealTimeMessage('Test message'));
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
