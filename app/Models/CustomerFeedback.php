<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFeedback extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFeedbackFactory> */
    use HasFactory;

    protected $primaryKey = 'cust_fb_id';
    protected $guarded = [];
    public $timestamps = false;
}
