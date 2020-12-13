<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PremiaController;


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
    return view('welcome');
});

Route::post('/api/data',[PremiaController::class, 'sendDetails']);
Route::post('/api/aboveFifty',[PremiaController::class, 'postAboveFifty']);
Route::post('/api/underFifty',[PremiaController::class, 'postUnderFifty']);
Route::any('{slug}',function(){
    return view('home');
});
