<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/setup', function() {
    Schema::create('users', function ($table) {
        $table->increments('id');
    });
});

Route::get('/', function () {
    $users = DB::select('select * from users where active = ?', [1]);
    return view('welcome');
});
