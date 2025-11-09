<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    /** @use HasFactory<\Database\Factories\PartFactory> */
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'part_id';

    public function suppliers()
    {
        return $this->belongsToMany(
            Supplier::class,
            'part_suppliers',
            'part_id',
            'sup_id'
        )->using(PartSupplier::class)
            ->withPivot(['unit_cost', 'min_order_quantity']);
    }
}
