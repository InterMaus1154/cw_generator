<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffCertification extends Model
{
    /** @use HasFactory<\Database\Factories\StaffCertificationFactory> */
    use HasFactory;

    protected $primaryKey = 'staff_cert_id';
    protected $guarded = [];
    public $timestamps = false;

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }
}
