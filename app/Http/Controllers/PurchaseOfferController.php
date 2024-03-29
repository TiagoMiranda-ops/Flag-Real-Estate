<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOffer;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Exception;

class PurchaseOfferController extends Controller
{

    public  function __construct()
    {
        $this->middleware('auth');
    }


    public function index() {

        $purchaseOffers = PurchaseOffer::all()->sortBy('property_id');

        return view('offers.index', [
            'purchaseOffers' => $purchaseOffers,
        ]);
    }

    public function sales(){

        $acceptedOffers= PurchaseOffer::where('purchase_offer_status', '=', 'Accepted')->orderBy('user_id', 'asc')->get();
        $totalValueSum = PurchaseOffer::where('purchase_offer_status', '=', 'Accepted')->sum('purchase_offer_value');

        if (Gate::allows('isAdmin', Auth::user())) {
            return view('offers.sales', [
                'acceptedOffers' => $acceptedOffers,
                'totalValueSum' => $totalValueSum,
            ]);
        }else{
            return redirect()->route('properties.index')->with('message-denied', 'Only administrators can review sale statistics - we run a tight ship.'); 
        };

    }

    public function create($getPropertyId) {

         if (Gate::allows('isCustomer', Auth::user())) {
            return view('offers.create', [
                'property' => $getPropertyId,
             ]);
        }else{
            return redirect()->route('properties.index')->with('message-denied', 'Only customers can make offers. No insider trading around here.'); 
        };
    }

    public function store(Request $request) {

        $validator = $this->validateStore($request);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }
        
        $purchaseOffer = new PurchaseOffer;
        $purchaseOffer->purchase_offer_date_entry = $request->get('purchase_offer_date_entry');
        $purchaseOffer->purchase_offer_status = $request->get('purchase_offer_status');
        $purchaseOffer->purchase_offer_value = $request->get('purchase_offer_value');
        $purchaseOffer->property_id = $request->get('property');
        $purchaseOffer->user_id = Auth::id();
        

        $purchaseOffer->save();

        return redirect()->route('offers.index')->with('message', 'Offer successfully made'); 


    }

    public function edit($purchase_offer_id) {

        $purchaseOffer = PurchaseOffer::findOrFail($purchase_offer_id);

        if (Gate::allows('isBroker', Auth::user())) {
            return view('offers.edit', [
                'purchaseOffer' => $purchaseOffer,
            ]);
        }else{
            return redirect()->route('offers.index')->with('message-denied', 'Only brokers are authorised to adjudicate offers.'); 
        };

    }

    public function update(Request $request, $purchase_offer_id) {

        $validator = $this->validateUpdate($request);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $purchaseOffer = PurchaseOffer::findOrFail($purchase_offer_id);
        
        $purchaseOffer->purchase_offer_status = $request->get('purchase_offer_status');

        $purchaseOffer->save();

        return redirect()->route('offers.index')->with('message', 'Offer successfully adjudicated');        
    }

    public function destroy($purchase_offer_id)
    {
        $purchaseOffer = PurchaseOffer::findOrFail($purchase_offer_id);

        if (Gate::allows('isAdmin', Auth::user())) {
            $purchaseOffer->delete();
            return redirect()->route('offers.index')->with('message-delete', 'Offer successfully deleted');
        }else{
            return redirect()->route('offers.index')->with('message-denied', 'Only administrators can delete offers - but why would anyone want that?');
        };
    }

    private function validateStore(Request $request)
    {

        $requirements = array(
            'purchase_offer_value' => 'required|numeric',
        );

        $customMessages = [
            'purchase_offer_value.numeric' => "Can't buy houses with words. That's stoopid with two o's.",
        ];

        return Validator::make($request->all(), $requirements, $customMessages);
    }

    private function validateUpdate(Request $request)
    {

        $requirements = array(
            'purchase_offer_status' => 'starts_with:Accepted,Declined',
        );

        $customMessages = [
            'purchase_offer_status.starts_with' => "Status can only be 'Accepted' or 'Declined'.",
        ];

        return Validator::make($request->all(), $requirements, $customMessages);
    }
}
