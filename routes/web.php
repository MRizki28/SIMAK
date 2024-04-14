<?php

use App\Helper\Helper;
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
    Route::post     ('/login',              'login');
    Route::post     ('/logout',             'logout');
});


Route::middleware(['web', 'auth'])->group(function () {

    Route::get('/', function () {
        return view('pages.dashboard');
    });

    Route::get('typedocument', function () {
        return view('pages.typedocument');
    });

    Route::get('arsip', function () {
        return view('pages.arsip');
    });

    Route::get('/usermanagement', function () {
        return view('pages.superadmin.usermanagement');
    });

    Route::get('/file/{id_user}/{id_arsip}', function ($id_user, $id_arsip) {
        if (!Helper::isValidUserId($id_user) || !Helper::isValidArsipId($id_arsip)) {
            abort(404);
        } else {
            return view('pages.file.file');
        }
    });

    Route::get('/personal-arsip', function () {
        return view('pages.managementarsip.personalyeararsip');
    });

    Route::get('/personal-arsip/jenis-dokumen/', function () {
        return view('pages.managementarsip.personalarsiptypedocument');
    });

    Route::get('/personal-arsip/jenis-dokumen/data', function () {
        return view('pages.managementarsip.personalarsip');
    });


    Route::get('/entire-arsip', function () {
        return view('pages.managementarsip.entirearsip.entirearsipuser');
    });

    Route::get('/entire-arsip/year', function () {
        return view('pages.managementarsip.entirearsip.entiryear');
    });

    Route::get('/entire-arsip/jenis-dokumen', function () {
        return view('pages.managementarsip.entirearsip.entirearspidocument');
    });

    Route::get('/entire-arsip/data', function () {
        return view('pages.managementarsip.entirearsip.entirearsip');
    });


    Route::prefix('v1')->group(function () {

        Route::prefix('auth')->controller(AuthController::class)->group(function () {
            Route::get      ('/',                   'getAllData');
            Route::post     ('/register',           'register');
            Route::get      ('/get/{id}',           'getDataById');
            Route::post     ('/resetpassword/{id}', 'resetPassword');
            Route::post     ('/update/{id}',        'updateData');
            Route::delete   ('/delete/{id}',        'deleteData');
        });

        Route::prefix('typedocument')->controller(TypeDocumentController::class)->group(function () {
            Route::get      ('/',               'getAllData');
            Route::get      ('/get/user',       'getDataByUser');
            Route::get      ('/get/user/document',       'getDataByUserYear');
            Route::get      ('/get/entire/document',       'getDataEntireTypeDocument');
            Route::post     ('/update/{id}',         'updateData');
            Route::post     ('/create',         'createData');
            Route::get      ('/get/{id}',       'getDataById');
            Route::post     ('/create',         'createData');
            Route::delete   ('/delete/{id}',    'deleteData');
        });

        Route::prefix('year')->controller(YearController::class)->group(function () {
            Route::get      ('/',               'getAllData');
            Route::get      ('/personal/get',               'getPersonalYear');
            Route::get      ('/entire/get',               'getEntireYear');
        });

        Route::prefix('arsip')->controller(ArsipController::class)->group(function () {
            Route::get      ('/',               'list');
            Route::get      ('/getpersonal',               'getDataArsipByPersonal');
            Route::get      ('/entire',               'getDataArsipByEntire');
            Route::get      ('file/{id_user}/{id_arsip}',               'getFile');
            Route::post     ('/create',         'createData');
            Route::post     ('/update/{id}',         'updateData');
            Route::delete   ('/delete/{id}',    'deleteData');
            Route::get      ('/get/{id}',       'getDataById');
            Route::delete   ('/delete/file/{id}',    'deleteFile');
            Route::post     ('/add/file',         'addFile');
        });

        Route::prefix('position')->controller(PositionController::class)->group(function () {
            Route::get      ('/',               'getAllData');
        });
    });
});
