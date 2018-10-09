<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Appointment; 

class Availability extends Model
{
    protected $fillable = [
        'firstHour', 'lastHour', 'minutesDuration', 'status'
    ];

    public static function generateHours($date){

        $availability     = (Availability::where('status', '=', 1)->orderBy('id', 'desc')->take(1)->get())[0];

        $appointments   = Appointment::listHours($date);


        $hours          = array();
        $cursorHour     = strtotime($availability->firstHour);
        $lastHour       = strtotime($availability->lastHour);

        while($cursorHour <= $lastHour){

            $currentHour = date('H:i', $cursorHour);
            
            if (!in_array($currentHour, $appointments)){
                $hours[] = $currentHour;
            }

            $minutes_to_add = $availability->minutesDuration;
            $cursorHour = strtotime ( '+' . $minutes_to_add . ' minute' , $cursorHour );
        }

        return $hours;
    }
}
