<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Appointment extends Model
{
    //
    protected $fillable = [
        'date', 'hour', 'name', 'phonenumber', 'email', 'status'
    ];

    public static function listHours($date){
        $appointments = Appointment::where('date', '=', $date)->get();

        $hours = array();

        foreach($appointments as $appoint){
            $hours[] = $appoint->hour;
        }

        return $hours;
    }
}
