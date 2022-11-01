<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $guarded = [];
    protected $fillable = ['color_name','color_rgb'];
    protected $primaryKey = 'color_id';
    protected $table = 'colors';
    // public function products(){
    //     return $this->belongsToMany(Product::class, 'product_colors','product_id','color_id');
    // }
}
