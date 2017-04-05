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

Route::get('/incoming-emails', function () {
    return view('incoming-emails');
});

Route::get('/facebook', function () {
    session_start(); //Session should be active

    $fb = new Facebook\Facebook([
        'app_id' => '1307471312669752', // Replace {app-id} with your app id
        'app_secret' => 'a83c57ef19741198d75487a3ba0442b4',
        'default_graph_version' => 'v2.2',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    $permissions = ['email']; // Optional permissions
    $loginUrl = $helper->getLoginUrl('http://localhost:8000/facebook-callback', $permissions);

    echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
    /*$fb = new Facebook\Facebook([
        'app_id' => '1307471312669752',
        'app_secret' => 'a83c57ef19741198d75487a3ba0442b4',
        'default_graph_version' => 'v2.4',
    ]);

    $fb->setDefaultAccessToken('EAASlI2MlTDgBAKECXq7uZCF5uVPvut3Hn4f5RzZADkMitBXnmXEpcZCosX89mtUKyrgvP6Yv9B9v9YPxxrDVByH0ZBSvwzoVDSA1VLOPTqZAav5qVqDjZC9kYQJNKiHKp8gJdrWZCdA2Niy9wzZBy8YGZBNjoAyZC3vpsPLckF1CpZBBYQ8Q2esQZCTz');

    try {
        $response = $fb->get('/1280097198744198/conversations');
       //$userNode = $response->getGraphUser();
        print("<pre>".print_r($response->getBody(),true)."</pre>"); exit;
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }*/
});

Route::get('/facebook-callback', function () {   
    session_start(); //Session should be active

    $fb = new Facebook\Facebook([
        'app_id' => '1307471312669752', // Replace {app-id} with your app id
        'app_secret' => 'a83c57ef19741198d75487a3ba0442b4',
        'default_graph_version' => 'v2.2',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    try {
        $accessToken = $helper->getAccessToken();
        var_dump($accessToken);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }  
});
