<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /** @use HasFactory<\Database\Factories\VehicleFactory> */
    use HasFactory;

    protected $primaryKey = 'vec_id';
    protected $guarded = [];
    public $timestamps = false;

    public function brand()
    {
        return $this->belongsTo(VehicleBrand::class, 'vec_brand_id', 'vec_brand_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cust_id', 'cust_id');
    }
}
