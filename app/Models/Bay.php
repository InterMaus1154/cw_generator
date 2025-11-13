<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bay extends Model
{
    /** @use HasFactory<\Database\Factories\BayFactory> */
    use HasFactory;

    protected $primaryKey = 'bay_id';
    protected $guarded = [];
    public $timestamps = false;

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }
}
