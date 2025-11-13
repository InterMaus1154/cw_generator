<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchManager extends Model
{
    /** @use HasFactory<\Database\Factories\BranchManagerFactory> */
    use HasFactory;

    protected $primaryKey = 'branch_man_id';
    protected $guarded = [];
    public $timestamps = false;

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }
}
