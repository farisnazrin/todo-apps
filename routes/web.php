<?php

use App\Http\Controllers\Auth\AuthController;
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
    Route::get('/home', function () {
        return view('dashboard.home');
    })->name('home');

    // Logout route (POST request)
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/')->with('status', 'Logged out!');
    })->name('logout');
});
