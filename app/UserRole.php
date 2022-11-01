<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    
    protected $guarded = [];
    protected $fillable = ['user_id','role_id'];
    protected $primaryKey = 'user_role_id';
    protected $table = 'tbl_user_role';
}
