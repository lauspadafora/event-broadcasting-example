<?php

use Illuminate\Http\Request;
use App\Events\NewMessageEvent;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    broadcast(new NewMessageEvent("Prueba", "Esta es una prueba", "21/03/2017"));
    return $request->user();
});
