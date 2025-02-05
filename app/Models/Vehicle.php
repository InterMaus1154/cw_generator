<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /** @use HasFactory<\Database\Factories\VehicleFactory> */
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'vehicle_id';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cust_id', 'cust_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'vehicle_id', 'vehicle_id');
    }
}
