<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
    protected $fillable = ['product_id','customer_id','comment_rate','comment_content', 'created_at'];
    protected $primaryKey = 'comment_id';
    protected $table = 'tbl_comment';
    public function Customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function CommentImages(){
        return $this->hasMany(CommentImage::class, 'comment_id');
    }
    public function CommentReplys(){
        return $this->hasMany(CommentReply::class,'comment_id');
    }
}
