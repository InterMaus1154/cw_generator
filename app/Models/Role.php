<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;

    protected $primaryKey = 'role_id';
    protected $guarded = [];
    public $timestamps = false;

    /**
     * Staff that have this role (pivot: staff_roles)
     */
    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'staff_roles', 'role_id', 'staff_id');
    }
}
