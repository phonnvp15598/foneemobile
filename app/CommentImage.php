<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentImage extends Model
{
    protected $guarded = [];
    protected $fillable = ['comment_id','comment_image'];
    protected $primaryKey = 'id';
    protected $table = 'comment_images';
    
}
