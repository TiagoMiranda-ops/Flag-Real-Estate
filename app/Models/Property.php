<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    public $timestamps = false;
    
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
        'user_id',
    ];

    public function purchaseOffer(){
        return $this->hasMany(PurchaseOffer::class, 'property_id', 'property_id');
    }

    public function userBroker(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function taggedProperties(){
        return $this->belongsToMany(User::class);
    }

}
