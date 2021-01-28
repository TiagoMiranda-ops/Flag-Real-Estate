<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'appointment_external_id',
        'customer_id', 
        'broker_id', 
    ];

    /*
    public function userCustomer(){
        return $this->belongsTo(User::class, 'customer_id', 'appointment_id');
    }

    public function userBroker(){
        return $this->belongsTo(User::class, 'broker_id', 'appointment_id');
    }
    */

}
