<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PurchaseOffer;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Exception;

class PropertyController extends Controller
{
    
    public  function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }
    
    
    public function index() {

        $properties = Property::all()->sortByDesc('property_price');

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

        //$this->authorize('create', Property::class);

        if (Gate::allows('isAdmin', Auth::user())) {
            return view('properties.create', [
                'properties' => Property::all(),
            ]);
        }elseif (Gate::allows('isBroker', Auth::user())) {
            return view('properties.create', [
                'properties' => Property::all(),
            ]);
        }else{
            return redirect()->route('properties.index')->with('message-denied', 'You are not authorised to add new properties.'); 
        };
    }

    public function store(Request $request) {

        

        $validator = $this->validateInput($request);

         if ($validator->fails()) {
            return redirect()->route('properties.create')->withErrors($validator->errors());
        }

        
        $property = new Property;
        $property->property_district = $request->get('property_district');
        $property->property_county = $request->get('property_county');
        $property->property_address = $request->get('property_address');
        $property->property_year = $request->get('property_year');
        $property->property_sqm = $request->get('property_sqm');
        $property->property_type = $request->get('property_type');
        $property->property_description = $request->get('property_description');
        $property->property_price = $request->get('property_price');
        $property->user_id = Auth::id();

        $property->save();

        return redirect()->route('properties.index')->with('message', 'Property successfully added'); 


    }


    public function edit($property_id) {

        $property = Property::findOrFail($property_id);


        if (Gate::allows('isAdmin', Auth::user())) {
            return view('properties.edit', [
                'property' => $property,
            ]);
        }elseif ( Gate::allows('isBroker', Auth::user()) && (Gate::allows('edit-property', $property)) ) {
            return view('properties.edit', [
                'property' => $property,
            ]);
        }else{
            return redirect()->route('properties.index')->with('message-denied', 'You are not authorised to edit another broker\'s property, or even properties altogether.'); 
        };

    }

    public function update(Request $request, Property $property) {

        $validator = $this->validateInput($request);
        
        if ($validator->fails()) {
            return redirect()->route('properties.edit', $property->property_id)->withErrors($validator->errors());
        }

        $property->property_district = $request->get('property_district');
        $property->property_county = $request->get('property_county');
        $property->property_address = $request->get('property_address');
        $property->property_year = $request->get('property_year');
        $property->property_sqm = $request->get('property_sqm');
        $property->property_type = $request->get('property_type');
        $property->property_description = $request->get('property_description');
        $property->property_price = $request->get('property_price');

        $property->save();

        return redirect()->route('properties.show', $property->property_id)->with('message', 'Property successfully edited');        
    }


    public function destroy(Property $property)
    {
       

        if (Gate::allows('isAdmin', Auth::user())) {

            $property->delete();
            return redirect()->route('properties.index')->with('message-delete', 'Property - and ANY related offers - successfully deleted');

        }elseif (Gate::allows('isBroker', Auth::user())) {

            $property->delete();
            return redirect()->route('properties.index')->with('message-delete', 'Property - and ANY related offers - successfully deleted');

        }else{
            return redirect()->route('properties.index')->with('message-denied', 'You are not authorised to delete any properties.'); 
        };
    }


    private function validateInput(Request $request)
    {

        $requirements = array(
            'property_district' => 'required|alpha',
            'property_county' => 'required|alpha',
            'property_address' => 'required',
            'property_year' => 'required|max:4',
            'property_sqm' => 'required|numeric',
            'property_type' => 'required',
            'property_description' => 'required',
            'property_price' => 'required|numeric',
        );

        $customMessages = [
            'alpha' => "This field may only accept letters. Don't be dumb.",
            'property_year.max' => "Only up to 4 numbers. By 10000 we will have been long gone.",
            'property_sqm.numeric' => "Only numbers. You're getting under my skin.",
            'property_price.numeric' => "Can't buy houses with words. That's stoopid with two o's.",
        ];

        return Validator::make($request->all(), $requirements, $customMessages);
    }



}
