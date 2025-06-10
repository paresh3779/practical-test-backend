<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['namespace' => 'App\Http\Controllers\API'], function() {
    Route::group(['namespace' => 'V1', 'prefix' => 'v1', 'as' => 'api.v1.'], function() {
        Route::post("userRegister", "UserController@regitser");
    });
});


