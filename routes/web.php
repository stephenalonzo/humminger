<?php

use App\Http\Controllers\HumController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing  

// Steps when running register(Request $request)
// - declare $userInput to validate input fields
// - run a bcrypt function to hash $userInput['password']
// - declare $user and assign to model User::create($userInput) to process input fields
// - automatically log user in with auth()->login($user)
// - return redirect to home page ('/')

// Steps when running logout(Request $request)
// - Call auth()->logout();
// - Call $request->session()->invalidate();
// - Call $request->session()->regenerateToken();
// - Return redirect to home page ('/')

// Show feed
Route::get('/', [HumController::class, 'index']);

// Store hum
Route::post('/', [HumController::class, 'store']);

// Create user
Route::get('/register', [UserController::class, 'create']);

// Store user
Route::post('/register', [UserController::class, 'store']);

// Show login
Route::get('/login', [UserController::class, 'login']);

// Log in user
Route::post('/authenticate', [UserController::class, 'authenticate']);

// View profile
Route::get('/users/{user}', [UserController::class, 'show']);