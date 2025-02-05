<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'emp_id';
    public $timestamps = false;

    public function employeeSchedules()
    {
        return $this->hasMany(EmployeeSchedule::class, 'emp_id', 'emp_id');
    }
}
