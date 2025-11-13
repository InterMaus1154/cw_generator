<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $primaryKey = 'job_id';
    protected $guarded = [];
    public $timestamps = false;

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }

    public function bookingService()
    {
        return $this->belongsTo('App\\Models\\BookingService', 'booking_service_id', 'booking_service_id');
    }

    public function bay()
    {
        return $this->belongsTo(Bay::class, 'bay_id', 'bay_id');
    }
}
