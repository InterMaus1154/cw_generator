<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentFactory> */
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];
    protected $primaryKey = 'dept_id';

    public function services()
    {
        return $this->hasMany(Service::class, 'dept_id', 'dept_id');
    }
}
