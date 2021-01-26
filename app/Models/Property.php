<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $primaryKey = 'property_id';

    protected $fillable = [
        'property_district', 
        'property_county',
        'property_address', 
        'property_year',
        'property_sqm', 
        'property_type',
        'property_description', 
        'property_price',
        'broker_id',
        'purchase_offer_id',
    ];

    public function purchaseOffer(){
        return $this->hasMany(PurchaseOffer::class, 'purchase_offer_id', 'property_id');
    }

    public function userBroker(){
        return $this->belongsTo(User::class, 'broker_id', 'property_id');
    }

}
