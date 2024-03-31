<?php

use App\Helper\Helper;
use App\Http\Controllers\CMS\AuthController;
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
});
