<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartTransfer extends Model
{
    use HasFactory;

    protected $table = 'part_transfers';
    protected $primaryKey = 'transfer_id';
    protected $guarded = [];
    public $timestamps = false;
}
