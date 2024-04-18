<?php

use App\Http\Controllers\API\ApiController;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/pegawai', function(){
    Return Pegawai::get();
});

Route::post('/login', [ApiController::class, 'login']);

Route::post('/cuti', [ApiController::class, 'cuti']);

Route::post('/izin', [ApiController::class, 'izin']);

Route::post('/absen', [ApiController::class, 'absen']);

Route::get('/riwayat-absensi/{id}', [ApiController::class, 'riwayatAbsensi']);

Route::get('/holiday', [ApiController::class, 'getDataHoliday']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
