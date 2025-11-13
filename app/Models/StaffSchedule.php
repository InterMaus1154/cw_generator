<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffSchedule extends Model
{
    /** @use HasFactory<\Database\Factories\StaffScheduleFactory> */
    use HasFactory;

    protected $primaryKey = 'schedule_id';
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'staff_schedule';

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }
}
