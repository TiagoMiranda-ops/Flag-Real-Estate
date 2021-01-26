<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PurchaseOffer;
use App\Models\User;

class PropertyController extends Controller
{
    
    public function index() {
        $properties = Property::all()->sortByDesc('property_id');

        return view('properties.index', [
            'properties' => $properties,
        ]);
    }

}
