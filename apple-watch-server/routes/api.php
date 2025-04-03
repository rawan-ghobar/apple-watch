<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CsvUploadController;
use App\Http\Controllers\ActivityController;

Route::group(["prefix" => "v0.1"], function(){
    //Authenticated Routes
    Route::group(["middleware" => "auth:api"], function(){

    //User Routes
    Route::group(["prefix" => "user"], function(){
        Route::post('/upload', [CsvUploadController::class, "upload"]);
        Route::get('/activities', [ActivityController::class, 'getActivities']);

    });
    });
    //Unauthenticated Routes
    Route::group(["prefix" => "guest"], function(){
        Route::post('/login', [AuthController::class, "login"]);
        Route::post('/signup', [AuthController::class, "signup"]);
    });


});
