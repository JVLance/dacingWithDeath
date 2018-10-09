<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $fillable = [
        'ip'
    ];

    public static function validateHours($ip){
        $conections = Connection::where('ip', '=', $ip)->orderBy('id', 'desc')->take(1)->get();

        if (count($conections) == 0){
            return true;
        }

        $conections = $conections[0];

        $hour_conection = strtotime($conections->created_at);
        
        $actual_hour    = time();

        
        $hours_elapsed  = $actual_hour - $hour_conection;
        
        if ($hours_elapsed < 3600){
            return false;
        }

        return true;
    }
}
