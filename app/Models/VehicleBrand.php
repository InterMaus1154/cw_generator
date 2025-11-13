<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleBrand extends Model
{
    /** @use HasFactory<\Database\Factories\VehicleBrandFactory> */
    use HasFactory;

    protected $primaryKey = 'vec_brand_id';
    protected $guarded  = [];
    public $timestamps = false;

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'vec_brand_id', 'vec_brand_id');
    }
}
