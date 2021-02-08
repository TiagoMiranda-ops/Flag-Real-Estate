<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\PurchaseOffer;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Facades\Http;

class AppointmentController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
    }

    public function index() {
        
        
        $response = Http::get('http://192.168.1.10/api/appointments');
        $appointments = $response->json();
        
        
        return view('appointments.index', compact('appointments'));
       
    }


}
