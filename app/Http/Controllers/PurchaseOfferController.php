<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOffer;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Exception;

class PurchaseOfferController extends Controller
{

    public  function __construct()
    {
        $this->middleware('auth');
    }


    public function index() {

        $purchaseOffers = PurchaseOffer::all()->sortByDesc('purchase_offer_status');

        return view('offers.index', [
            'purchaseOffers' => $purchaseOffers,
        ]);
    }

    public function sales(){

        $acceptedOffers= PurchaseOffer::where('purchase_offer_status','Accepted');

        return view('offers.sales', [
            'acceptedOffers' => $acceptedOffers,
        ]);
    }

    public function create($getPropertyId) {

        return view('offers.create', [
            'property' => $getPropertyId,
         ]);
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

        return view('offers.edit', [
            'purchaseOffer' => $purchaseOffer,
        ]);
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
        $purchaseOffer->delete();

        return redirect()->route('offers.index')->with('message-delete', 'Offer successfully deleted');
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
