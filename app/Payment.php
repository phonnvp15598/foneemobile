<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];
    protected $fillable = ['payment_method','payment_status'];
    protected $primaryKey = 'payment_id';
    protected $table = 'tbl_payment';
}
