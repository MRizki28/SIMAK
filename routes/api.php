<?php

use App\Http\Controllers\CMS\ArsipController;
use App\Http\Controllers\CMS\TypeDocumentController;
use App\Http\Controllers\CMS\YearController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {

    Route::prefix('typedocument')->controller(TypeDocumentController::class)->group(function() {
        Route::get      ('/'            , 'getAllData');
        Route::post     ('/create'      , 'createData');
        Route::get      ('/get/{id}'    , 'getDataById');
        Route::post     ('/update/{id}' , 'updateData');
        Route::delete   ('/delete/{id}' , 'deleteData');
    });

    Route::prefix('year')->controller(YearController::class)->group(function()  {
        Route::get      ('/'            , 'getAllData');
    });

    Route::prefix('arsip')->controller(ArsipController::class)->group(function()  {
        Route::get      ('/'            , 'list');
        Route::post     ('/create'      , 'createData');
    });
    
});