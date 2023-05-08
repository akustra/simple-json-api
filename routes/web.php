<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WordController;
use Carbon\Carbon;
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
    return response()->json(['ok']);
});

Route::get('/ping', function () {
    return response()->json([
        "data" => [
            "date" => Carbon::now()->format('Y-m-s H:i:s')
        ]
    ]);
});

// Words API

Route::get('/words', [WordController::class, 'index']);
Route::get('/words/{id}', [WordController::class, 'show']);

Route::get('/translate', [WordController::class, 'translate']);

Route::post('/words', [WordController::class, 'store']);

require __DIR__ . '/auth.php';
