<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded = [];
    protected $fillable = ['brand_name','brand_desc','brand_status','brand_slug'];
    protected $primaryKey = 'brand_id';
    protected $table = 'tbl_brand';
}
