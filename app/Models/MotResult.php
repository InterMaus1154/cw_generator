<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotResult extends Model
{
    use HasFactory;

    protected $table = 'mot_results';
    protected $primaryKey = 'mot_res_id';
    protected $guarded = [];
    public $timestamps = false;
}
