<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }
    
    public function purchaseOffer(){
        return $this->hasMany(PurchaseOffer::class, 'user_id', 'user_id');
    }

    public function property(){
        return $this->hasMany(Property::class, 'user_id', 'user_id');
    }

    public function userFavourites(){
        return $this->belongsToMany(Property::class);
    }



    /*
    public function appointment(){
        return $this->hasMany(Appointment::class, 'appointment_id', 'user_id');
    }
    */


}
