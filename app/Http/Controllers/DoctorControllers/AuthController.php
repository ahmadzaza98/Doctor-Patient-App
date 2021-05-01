<?php

namespace App\Http\Controllers\DoctorControllers;

use App\Http\Controllers\Controller;
use App\Models\DoctorModels\Doctor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\DoctorModels\Hospital;
use App\Models\DoctorModels\Speciality;


class AuthController extends Controller
{
    public function DoctorSignUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|string|unique:doctors',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        //$doctor = Doctor::create($request->all());
        $doctor = Doctor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'username' => $request->username,
            'speciality_id' => $request->speciality_id ?? null ,
            // ? null : $request->speciality_id,
            'hospital_id' => $request->hospital_id ?? null ,
            // ? null : $request->hospital_id,
            'experience' => $request->experience ?? null ,
            // ? null : $request->experience,
            'about_you' => $request->about_you ?? null,
             //? null : $request->about_you,
            'picked_appointment' => false
        ]);

        if ($doctor->speciality_id != null) {
            $doctor['speciality'] = Speciality::find($doctor->speciality_id);
        }
        if ($doctor->hospital_id != null) {
            $doctor['hospital'] = Hospital::find($doctor->hospital_id);
        }
        $doctor->Has_Clinics = false;



        $token = JWTAuth::fromUser($doctor);
        $doctor['token'] = $token;
        return response()->json([
            'result' => $doctor,
        ], 200);
    }



    public function DoctorSignIn(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255',
                'password' => 'required|string|min:6'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            $credentials = $request->only('username', 'password');
            $token = Auth::guard('doctor-api')->attempt($credentials);
            //return response()->json($token);
            if (!$token) {
                return response()->json([
                    'result' => 'Invalid Input',
                ], 400);
            }
            $doctor = Auth::guard('doctor-api')->user();
            if ($doctor->speciality_id != null) {
                $doctor['speciality'] = Speciality::find($doctor->speciality_id);
            }
            if ($doctor->hospital_id != null) {
                $doctor['hospital'] = Hospital::find($doctor->hospital_id);
            }
            $doctor->Has_Clinics = $doctor->CheckDoctorClinics($doctor);
            $doctor->token = $token;

            return response()->json([
                'result' => $doctor,
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'result' => $ex->getMessage(),
            ], $ex->getCode());
        }
    }
}
