<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    protected $primaryKey = 'booking_id';
    protected $guarded = [];
    public $timestamps = false;

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vec_id', 'vec_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }
}
