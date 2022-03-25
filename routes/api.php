<?php

use App\Http\Controllers\ConsultationsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocietiesController;
use App\Http\Controllers\SpotsController;
use App\Http\Controllers\VaccinationsController;
use App\Models\Consultations;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/getsocietiesdata', [SocietiesController::class, 'index']);
Route::post('/v1/auth/login', [SocietiesController::class, 'login']);
Route::post('/v1/auth/logout/{token}', [SocietiesController::class, 'logout']);

// consultations
Route::post('/v1/consultations/{token}', [ConsultationsController::class, 'store']);
Route::get('/consultations/{token}', [ConsultationsController::class, 'index']);

// spots
Route::get('/v1/spots/{token}', [SpotsController::class, 'getbytoken']);
Route::get('/v1/spots/{token}/{date}/{id_spot}', [SpotsController::class, 'getspotdetail']);

// Vaccinations
Route::get('/getdetailvaksinbytoken/{token}', [VaccinationsController::class, 'index']);
Route::post('/RegisterVaccination/{token}', [VaccinationsController::class, 'store']);
