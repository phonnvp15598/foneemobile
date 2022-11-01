<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    protected $guarded = [];
    protected $fillable = ['comment_id','customer_id', 'comment_reply_content'];
    protected $primaryKey = 'id';
    protected $table = 'comment_replies';
    public function CustomerReply(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
