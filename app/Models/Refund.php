<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $primaryKey = 'refund_id';
    protected $guarded = [];
    public $timestamps = false;

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'inv_id', 'inv_id');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'refunded_by', 'staff_id');
    }
}
