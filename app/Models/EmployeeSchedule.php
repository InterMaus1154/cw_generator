<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSchedule extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeScheduleFactory> */
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    protected $primaryKey = 'emp_schedule_id';

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id', 'emp_id');
    }
}
