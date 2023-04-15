<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estatus extends Model
{
    public function scopedescripcion($query,$search)
    {
        if($search){
            return $query->where('descripcion', 'LIKE', "%$search%");}
        
    
    }
}
