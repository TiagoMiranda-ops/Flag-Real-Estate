<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOffer extends Model
{
    use HasFactory;

    protected $primaryKey = 'purchase_offer_id';

    protected $fillable = [
        'purchase_offer_date_entry', 
        'purchase_offer_date_response',
        'purchase_offer_date_status', 
        'purchase_offer_value',
        'property_id', 
        'user_id',
    ];

    public function userCustomer(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function property(){
        return $this->belongsTo(Property::class, 'property_id', 'property_id');
    }

}
