<?php

namespace App\Models\DoctorModels;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Doctor extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'doctors';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'username',
        'speciality_id',
        'hospital_id',
        'experience',
        'about_you',
        'picked_appointment',
        'created_at',
        'updated_at'
    ];
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    public function CheckDoctorClinics($doctor){
        if(count($doctor->clinics()->get())){
            return true;
           //return $doctor->clinics()->get();
        }
        return false;
    }
    public function clinics(){
        return $this->hasMany(Clinic::class);
    }

    public function speicialty()
    {
        return $this->belongsTo(Speciality::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Speciality::class);
    }
}
