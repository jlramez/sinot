<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class interposicion extends Model
{
    public function scopedescripcion($query,$search)
    {
        if($search){
            return $query->where('descripcion', 'LIKE', "%$search%");}
        
    
    }
}
