<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    /** @use HasFactory<\Database\Factories\EmergencyContactFactory> */
    use HasFactory;

    protected $table = 'customer_emergency_contacts';
    protected $primaryKey = 'emg_id';
    protected $guarded = [];
    public $timestamps = false;
}
