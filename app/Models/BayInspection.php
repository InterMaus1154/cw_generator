<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BayInspection extends Model
{
    /** @use HasFactory<\Database\Factories\BayInspectionFactory> */
    use HasFactory;

    protected $primaryKey = 'inspection_id';
    protected $guarded = [];
    public $timestamps = false;

    public function bay()
    {
        return $this->belongsTo(Bay::class, 'bay_id', 'bay_id');
    }

    public function inspector()
    {
        return $this->belongsTo(Staff::class, 'inspected_by', 'staff_id');
    }
}
