<?php

namespace App\Http\Controllers\DoctorControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoctorModels\Doctor;
use Illuminate\Support\Facades\Validator;

class DoctorProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $doctor = Doctor::find($id);
        $validator = Validator::make($request->all() , [
            'username' => 'required|string|unique:doctors|max:25',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $doctor->update($request->all());
        return response()->json([
            'doctor' => $doctor
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
