<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $guarded = [];
    protected $fillable = ['admin_name','admin_email','admin_password','admin_phone'];
    protected $primaryKey = 'admin_id';
    protected $table = 'tbl_admin';
}
