<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMemory extends Model
{
    protected $guarded = [];
    protected $fillable = ['product_id','memory_id'];
    protected $primaryKey = 'product_memory_id';
    protected $table = 'product_memories';
    public function memories(){
        //nhieu - 1
        return $this->belongsTo(Memory::class, 'memory_id');
    }
}
