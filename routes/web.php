<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Models\Task;
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


// 👇 Add these two routes for login and register
Route::get('/login', function () {
    return view('auth.login'); // Replace with view('auth.login') if you have a blade
})->name('login');

Route::get('/register', function () {
    return view('auth.register'); // Replace with view('auth.register') if you have a blade
})->name('register');

Route::post('/register', [AuthController::class, 'store'])->name('register.store');

Route::post('/login', [AuthController::class, 'login'])->name('do.login');


// 👇 Group routes that require authentication
Route::middleware(['auth'])->group(function () {

    // Landing page (after login/register)
    Route::middleware('auth')->group(function () {
        Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
        Route::post('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
        Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    });

    // Logout route (POST request)
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/')->with('status', 'Logged out!');
    })->name('logout');

  


});
