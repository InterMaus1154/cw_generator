<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    protected $primaryKey = 'inst_id';
    protected $guarded = [];
    public $timestamps = false;

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'inv_id', 'inv_id');
    }
}
