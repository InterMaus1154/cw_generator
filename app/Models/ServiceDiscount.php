<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDiscount extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceDiscountFactory> */
    use HasFactory;

    protected $primaryKey = 'disc_id';
    protected $guarded = [];
    public $timestamps = false;

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }
}
