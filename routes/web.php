<?php

use Illuminate\Http\Request;


Route::get('/', function () {
    $links = \App\Link::all();
    $id = null;
    return view('welcome')->withLinks($links, $id);
});

Route::get('/submit', function () {
    return view('submit');
});

Route::post('/submit', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'url' => 'required|url|max:255',
        'description' => 'required|max:255',
    ]);
    $link = tap(new App\Link($data))->save();
    return redirect('/');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->name('card')->get('/cards/{card}', 'CardController@show');
Route::get('/leaderboard', 'CardController@leaderboard');
