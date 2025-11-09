<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'sup_id';
    public $timestamps = false;

    public function parts()
    {
        return $this->belongsToMany(
            Part::class,
            'part_suppliers',
            'sup_id',
            'part_id'
        )->using(PartSupplier::class)
            ->withPivot(['unit_cost', 'min_order_quantity']);
    }
}
