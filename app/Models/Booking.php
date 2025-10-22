<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    protected $fillable = [
        'patient_name',
        'doctor_name',
        'appointment_date',
        'appointment_time',
        'status',
    ];

    protected $table = 'bookings';

    public function getAppointmentDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    } 

    public function getAppointmentTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i');
    }
}
