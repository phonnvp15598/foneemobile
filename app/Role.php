<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $guarded = [];
    protected $fillable = ['role_name'];
    protected $primaryKey = 'role_id';
    protected $table = 'tbl_roles';
    public function users(){
        return $this->belongsToMany(User::class, 'tbl_user_role','user_id','role_id');
    }
}
