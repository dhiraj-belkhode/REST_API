<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/



require __DIR__.'/app/start.php';
use App\Route;

Route::get('testobj', 'UserController@work');
Route::get('ask', 'UserController@worka');
Route::post('testobj', 'UserController@workpost');