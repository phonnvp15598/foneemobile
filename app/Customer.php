<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];
    protected $fillable = ['customer_name','customer_email','customer_password','customer_active','customer_code'];
    protected $primaryKey = 'customer_id';
    protected $table = 'tbl_customer';
}
