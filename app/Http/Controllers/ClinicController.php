<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\DoctorModels\Doctor;
use App\Models\Address;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClinicController extends Controller
{

    public function __construct()
    {
        $this->middleware('assign.guard');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validation = Validator::make($request->all(),[
        //     'doctor_id' => 'required',
        //     'address_id' => 'required',
        //     'area_id' => 'required',
        //     'address_details' => 'required',
        //     'phone_number' => '',
        //     'open_at' => '',
        //     'close_at' => '',
        // ]);

        // if($validation->fails()){
        //     return response()->json($validation->errors()->toJson(),400);
        // }


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


    public function GetDocotrCilnics($id){
        $doctor = Doctor::find($id);
        $doctor['clinics'] = $doctor->clinics()->get();
        //$newC = [];
        foreach($doctor['clinics'] as $clinic){
            $clinic->address = Address::find($clinic -> address_id);
            $clinic->area = Area::find($clinic->area_id);
            // $clinic['address'] = Address::find($clinic -> address_id);
            // $clinic['area'] = Area::find($clinic -> area_id);
            // array_push($newC , $clinic);
        }

        return response()->json([
            //'result' => $newC,
            'result' => $doctor,
        ],200);
    }
}
