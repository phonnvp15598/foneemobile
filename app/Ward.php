<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $guarded = [];
    protected $fillable = ['ward_name','ward_type','district_id'];
    protected $primaryKey = 'ward_id';
    protected $table = 'wards';
}
