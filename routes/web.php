<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Route urutan: LOGIN → SPLASH → DASHBOARD → PENGELOLAAN → PROFILE → LOGOUT
| Menggunakan query parameter ?username=… untuk “membawa” username.
|
*/

// 1. Root → redirect ke /login
Route::redirect('/', '/login');

// 2. Halaman Login (GET & POST)
Route::get('/login',  [PageController::class, 'showLogin']);
Route::post('/login', [PageController::class, 'doLogin']);

// 3. Splash screen (GET, di luar middleware apapun)
Route::get('/splash', [PageController::class, 'splash']);

// 4. Halaman setelah login, semuanya pake query-param ?username=
Route::get('/dashboard',           [PageController::class, 'dashboard']);
Route::get('/pengelolaan',         [PageController::class, 'pengelolaan']);
Route::post('/pengelolaan/create', [PageController::class, 'createBook']);
Route::post('/pengelolaan/delete/{id}', [PageController::class, 'deleteBook']);
Route::get('/profile',             [PageController::class, 'profile']);

// 5. Logout (POST) → kembali ke /login
Route::post('/logout', function (Request $request) {
    return redirect('/login');
});
