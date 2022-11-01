<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    protected $guarded = [];
    protected $fillable = ['memory_name'];
    protected $primaryKey = 'memory_id';
    protected $table = 'memories';
    public function products(){
        return $this->belongsToMany(Product::class, 'product_memories','product_id','memory_id');
    }
}
