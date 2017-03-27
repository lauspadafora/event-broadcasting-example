<?php

use Illuminate\Http\Request;
use App\Events\NewMessageEvent;

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

Route::get('/event', function () {
    event(new NewMessageEvent());
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//Chat routes
Route::get('/chat', function () {
    return view('chat');
})->middleware('auth');

Route::post('/send-message', function (Request $request) {          
    //broadcast(new NewMessageEvent($request->name, $request->msg))->toOthers();
    broadcast(new NewMessageEvent($request->name, $request->msg, $request->date));
});

Route::get('/twitter-direct-messages', function () {
    return view('twitter');
});