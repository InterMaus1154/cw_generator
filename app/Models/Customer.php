<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'cust_id';
    protected $guarded = [];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'cust_id', 'cust_id');
    }
}
