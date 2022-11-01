<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $guarded = [];
    protected $fillable = ['product_id','color_id'];
    protected $primaryKey = 'product_color_id';
    protected $table = 'product_colors';
    public function colors(){
        //nhieu - 1
        return $this->belongsTo(Color::class, 'color_id');
    }
}
