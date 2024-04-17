<?php

use App\Http\Controllers\CMS\ArsipController;
use App\Http\Controllers\CMS\AuthController;
use App\Http\Controllers\CMS\PositionController;
use App\Http\Controllers\CMS\TypeDocumentController;
use App\Http\Controllers\CMS\YearController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('Auth.Login');
    })->name('login');
});

Route::prefix('v1/auth')->controller(AuthController::class)->group(function () {
    Route::post('/login',              'login');
    Route::post('/logout',             'logout');
});


Route::middleware(['web', 'auth'])->group(function () {

    Route::get('/', function () {
        return view('pages.dashboard');
    })->middleware('rolemanagement:superadmin,user');

    Route::get('typedocument', function () {
        return view('pages.typedocument');
    })->middleware('rolemanagement:user');

    Route::get('arsip', function () {
        return view('pages.arsip');
    })->middleware('rolemanagement:user');

    Route::get('/usermanagement', function () {
        return view('pages.superadmin.usermanagement');
    })->middleware('rolemanagement:superadmin');

    Route::get('/file/personal', function () {
        return view('pages.file.file');
    })->middleware('rolemanagement:superadmin,user');

    Route::get('/personal-arsip', function () {
        return view('pages.managementarsip.personalyeararsip');
    })->middleware('rolemanagement:user');

    Route::get('/personal-arsip/jenis-dokumen/', function () {
        return view('pages.managementarsip.personalarsiptypedocument');
    })->middleware('rolemanagement:user');

    Route::get('/personal-arsip/jenis-dokumen/data', function () {
        return view('pages.managementarsip.personalarsip');
    })->middleware('rolemanagement:user');


    Route::get('/entire-arsip', function () {
        return view('pages.managementarsip.entirearsip.entirearsipuser');
    })->middleware('rolemanagement:superadmin,user');

    Route::get('/entire-arsip/year', function () {
        return view('pages.managementarsip.entirearsip.entiryear');
    })->middleware('rolemanagement:superadmin,user');

    Route::get('/entire-arsip/jenis-dokumen', function () {
        return view('pages.managementarsip.entirearsip.entirearspidocument');
    })->middleware('rolemanagement:superadmin,user');

    Route::get('/entire-arsip/data', function () {
        return view('pages.managementarsip.entirearsip.entirearsip');
    })->middleware('rolemanagement:superadmin,user');

    Route::get('/setting', function () {
        return view('pages.settings');
    })->middleware('rolemanagement:user');

    Route::prefix('v1')->group(function () {
        Route::prefix('auth')->controller(AuthController::class)->group(function () {
            Route::get('/',                   'getAllData');
            Route::get('/getforarsip',                   'getDataForArsip');
            Route::post('/register',           'register');
            Route::get('/get/{id}',           'getDataById');
            Route::post('/resetpassword/{id}', 'resetPassword');
            Route::post('/update/{id}',        'updateData');
            Route::delete('/delete/{id}',        'deleteData');
            Route::post('/setting',           'setting');
        });

        Route::prefix('typedocument')->controller(TypeDocumentController::class)->group(function () {
            Route::get('/',               'getAllData');
            Route::get('/get/user',       'getDataByUser');
            Route::get('/get/user/document',       'getDataByUserYear');
            Route::get('/get/entire/document',       'getDataEntireTypeDocument');
            Route::post('/update/{id}',         'updateData');
            Route::post('/create',         'createData');
            Route::get('/get/{id}',       'getDataById');
            Route::post('/create',         'createData');
            Route::delete('/delete/{id}',    'deleteData');
        });

        Route::prefix('year')->controller(YearController::class)->group(function () {
            Route::get('/',               'getAllData');
            Route::get('/personal/get',               'getPersonalYear');
            Route::get('/entire/get',               'getEntireYear');
        });

        Route::prefix('arsip')->controller(ArsipController::class)->group(function () {
            Route::get('/',               'list');
            Route::get('/getpersonal',               'getDataArsipByPersonal');
            Route::get('/entire',               'getDataArsipByEntire');
            Route::get('file',               'getFile');
            Route::post('/create',         'createData');
            Route::post('/update/{id}',         'updateData');
            Route::delete('/delete/{id}',    'deleteData');
            Route::get('/get/{id}',       'getDataById');
            Route::delete('/delete/file/{id}',    'deleteFile');
            Route::post('/add/file',         'addFile');
        });

        Route::prefix('position')->controller(PositionController::class)->group(function () {
            Route::get('/',               'getAllData');
        });
    });
});
