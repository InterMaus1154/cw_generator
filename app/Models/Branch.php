<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    /** @use HasFactory<\Database\Factories\BranchFactory> */
    use HasFactory;

    protected $primaryKey = 'branch_id';
    protected $guarded = [];
    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo(City::class, 'branch_city', 'city_id');
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'branch_id', 'branch_id');
    }
}
