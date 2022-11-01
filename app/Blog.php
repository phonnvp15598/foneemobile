<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];
    protected $fillable = ['user_id','blog_title','blog_content','blog_slug','blog_status','blog_thumb'];
    protected $primaryKey = 'blog_id';
    protected $table = 'blogs';

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
