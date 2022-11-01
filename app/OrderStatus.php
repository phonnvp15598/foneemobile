<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $guarded = [];
    protected $fillable = ['order_status_name'];
    protected $primaryKey = 'order_status';
    protected $table = 'order_statuses';
}
