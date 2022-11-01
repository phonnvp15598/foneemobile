<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];
    protected $fillable = ['city_name','city_type'];
    protected $primaryKey = 'city_id';
    protected $table = 'cities';
}
