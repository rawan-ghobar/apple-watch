<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CsvUploadController;

Route::group(["prefix" => "v0.1"], function(){
    //Authenticated Routes
    Route::group(["middleware" => "auth:api"], function(){

    //User Routes
    Route::group(["prefix" => "user"], function(){
        Route::post('/upload', [CsvUploadController::class, "upload"]);
   });
    });
    //Unauthenticated Routes
    Route::group(["prefix" => "guest"], function(){
        Route::post('/login', [AuthController::class, "login"]);
        Route::post('/signup', [AuthController::class, "signup"]);
    });


});
