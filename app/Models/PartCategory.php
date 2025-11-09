<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartCategory extends Model
{
    /** @use HasFactory<\Database\Factories\PartCategoryFactory> */
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'part_cat_id';
}
