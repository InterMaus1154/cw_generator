<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFeedback extends Model
{
    use HasFactory;

    protected $primaryKey = 'cust_fb_id';
    protected $guarded = [];
    public $timestamps = false;
    protected $table = 'customer_feedbacks';

    public function replies()
    {
        return $this->hasMany(FeedbackReply::class, 'cust_fb_id', 'cust_fb_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cust_id', 'cust_id');
    }
}
