<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PurchaseOffer;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;

class PropertyController extends Controller
{
    
    public function index() {

        $properties = Property::all()->sortByDesc('property_id');

        return view('properties.index', [
            'properties' => $properties,
        ]);
    }

    public function show($property_id) {
    
        $property = Property::findOrFail($property_id);
    
        return view('properties.show', [
            'property' => $property,
        ]);
    }

    public function create() {

        return view('properties.create', [
             'properties' => Property::all(),
         ]);
    }

    public function store(Request $request) {

        
        $property = new Property;
        $property->property_district = $request->get('property_district');
        $property->property_county = $request->get('property_county');
        $property->property_address = $request->get('property_address');
        $property->property_year = $request->get('property_year');
        $property->property_sqm = $request->get('property_sqm');
        $property->property_type = $request->get('property_type');
        $property->property_description = $request->get('property_description');
        $property->property_price = $request->get('property_price');

        $property->save();

        return redirect()->route('properties.index')->with('message', 'Property successfully added'); 


    }




}
