<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ChildParent;
use App\Models\Doctor;

use App\Models\Post;
use Illuminate\Support\Facades\Config;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index_1()
    {
        return response([
            'appointments' => Appointment::orderBy('created_at', 'desc')
            ->get()
        ], 200);
    }

    public function show_1($id)
    {
        $appointment = Appointment::find($id);
        if(!$appointment)
        {
            return response([
                'message' => 'appointment not found.'
            ], 403);
        }
        return response([
            'appointment' => Appointment::where('id', $id)->get()
        ], 200);
    }

    public function store_1(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'name' => 'required|string|between:2,100' ,
            'day' => 'date|between:2,100',
            'hour' => 'string|between:2,100',
        ]);
     

        $appointment = Appointment::create([
            'name' => $attrs['name'],
            'day' => $attrs['day'],
            'hour' =>$attrs['hour'],
            

        ]);


        return response([
            'message' => 'appointment created.',
            'appointment' => $appointment,
        ], 200);
    }

    public function update_1(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if(!$appointment)
        {
            return response([
                'message' => 'appointment not found.'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'name' => 'required|string|between:2,100' ,
            'day' => 'date|between:2,100',
            'hour' => 'string|between:2,100',
        ]);


        $appointment->update([
            'name' => $attrs['name'],
            'day' => $attrs['day'],
            'hour' =>$attrs['hour'],
            
        ]);
        return response([
            'message' => 'appointment updated.',
            'appointment' => $appointment
        ], 200);
    }
    public function destroy_1($id)
    {
        $appointment = Appointment::find($id);

        if(!$appointment)
        {
            return response([
                'message' => 'appointment not found.'
            ], 403);
        }


        return response([
            'message' => 'appointment deleted.'
        ], 200);
    }

// parentttttttttttttttttttttttttttttttt


public function store(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'name' => 'required|string|between:2,100' ,
            'day' => 'date|between:2,100',
            'hour' => 'string|between:2,100',
        ]);
     

        $appointment = Appointment::create([
            'name' => $attrs['name'],
            'day' => $attrs['day'],
            'hour' =>$attrs['hour'],
            

        ]);


        return response([
            'message' => 'appointment created.',
            'appointment' => $appointment,
        ], 200);
    }

     // get single appointment
     public function show($id)
     {
         return response([
             'post' => Post::where('id', $id)->get()
         ], 200);
     }
// get all appointments 
     public function index()
     {
         return response([
             'appointments' => Appointment::orderBy('created_at', 'desc')
             ->get()
         ], 200);
     }
     // parent delay appointment
     public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if(!$appointment)
        {
            return response([
                'message' => 'appointment not found.'
            ], 403);
        }

        //validate fields
        $attrs = $request->validate([
            'name' => 'required|string|between:2,100' ,
            'day' => 'date|between:2,100',
            'hour' => 'string|between:2,100,unique:appointments',
        ]);


        $appointment->update([
            'name' => $attrs['name'],
            'day' => $attrs['day'],
            'hour' =>$attrs['hour'],
            
        ]);
        return response([
            'message' => 'appointment updated.',
            'appointment' => $appointment
            
        ], 200);
    }
    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        if(!$appointment)
        {
            return response([
                'message' => 'appointment not found.'
            ], 403);
        }


        return response([
            'message' => 'appointment deleted.'
        ], 200);


}
}
