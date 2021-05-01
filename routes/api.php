<?php

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DoctorControllers\AuthController;
use App\Http\Controllers\DoctorControllers\HospitalController;
use App\Http\Controllers\DoctorControllers\SpecialityController;
use App\Http\Controllers\DoctorControllers\DoctorProfileController;
use App\Http\Controllers\DoctorProfeleController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



    Route::group(['prefix' => 'doctor'] , function() {
        Route::POST('/signup' ,[AuthController::class , 'DoctorSignUp']);
        Route::POST('/signin' ,[AuthController::class , 'DoctorSignIn']);
        Route::apiResource('/clinic' , ClinicController::class);
        Route::GET('/clinics/{doctor_id}' , [ClinicController::class , 'GetDocotrCilnics']);
        Route::apiResource('/specialities' , SpecialityController::class);
        Route::apiResource('/hospitals' , HospitalController::class);
        Route::apiResource('/profile' , DoctorProfileController::class);
    //    Route::GET('GetAllHospitals', [HospitalController::class, 'index']);

    });

