<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackReply extends Model
{
    use HasFactory;

    protected $primaryKey = 'reply_id';
    protected $guarded = [];
    public $timestamps = false;

    public function feedback()
    {
        return $this->belongsTo(CustomerFeedback::class, 'cust_fb_id', 'cust_fb_id');
    }

    public function parent()
    {
        return $this->belongsTo(FeedbackReply::class, 'reply_to', 'reply_id');
    }
}
