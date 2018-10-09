<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\Availability;
use App\Connection;
use App\Http\Requests\CreateAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;

class AppointmentsController extends Controller
{
    //

    public function index($dateAppointment){
        $hours = Availability::generateHours($dateAppointment);

        return response()->json(['response' => 'success', 'hours' => $hours]);
    }

    public function read(){
        $appointment = new Appointment();
        
        return response()->json(
            $this->pagination($appointment, ['date', 'hour', 'name', 'phonenumber', 'email'])
        )
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET');
    }

    public function create(Request $request){
        $rules          =   (new CreateAppointmentRequest())->rules();
        $validator      =   \Validator::make($request->all(), $rules);
        $appointment    =   new Appointment();

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }

        if (!Connection::validateHours(\Request::getClientIp(true))){
            return response()->json(['response' => 'error', 'Message' => 'An appointment has already been saved. It is necessary to wait one hour from the last reservation to be able to schedule another appointment.']);
        }

        $appointment->hour          = $request->input('hour');
        $appointment->date          = $request->input('date');
        $appointment->name          = $request->input('name');
        $appointment->phonenumber   = $request->input('phonenumber');
        $appointment->email         = $request->input('email');
        $appointment->status        = 1;   

        if ($appointment->save()){
            $con = new Connection();
            $con->ip = \Request::getClientIp(true);
            $con->save();

            return response()->json(['response' => 'success', 'Message' => 'Appointment saved successfully']);
        }

        return response()->json(['response' => 'error', 'Message' => 'An unexpected error occurred while saving the appointment']);
    }

    public function delete($id){
        if(Appointment::destroy($id)){
            return response()->json(['response' => 'success', 'Message' => 'The appointment has been successfully eliminated']);
        }

        return response()->json(['response' => 'error', 'Message' => 'An unexpected error occurred while deleting the appointment']);
    }


    private function pagination($model, $fields = null){
        $request    = request();

        $sort       = request()->has('sort') ? explode('|', request()->sort) : array();

        if (count($sort) > 1) {
            list($sortCol, $sortDir) = $sort;
            $query = $model->orderBy($sortCol, $sortDir);
        } else {
            $query = $model->orderBy('id', 'asc');
        }

        if ($request->exists('filter') && !is_null($fields)) {
            $query->where(function($q) use($request, $fields) {
                
                $value = "%{$request->filter}%";

                foreach($fields as $field){
                    if ($field == $fields[0]){
                        $q->where($field, 'like', $value);
                        continue;
                    }

                    $q->orWhere($field, 'like', $value);
                }
            });
        }

        $returned = request()->has('per_page') ? (int) request()->per_page : null;

        return $query->paginate($returned);
    }
}
