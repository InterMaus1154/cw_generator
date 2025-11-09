<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartSupplier extends Model
{
    /** @use HasFactory<\Database\Factories\PartSupplierFactory> */
    use HasFactory;

    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
        'unit_cost' => 'decimal:2',
        'min_order_quantity' => 'integer',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'sup_id', 'sup_id');
    }

    public function part()
    {
        return $this->belongsTo(Part::class, 'part_id', 'part_id');
    }
}
