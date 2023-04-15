<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class juicio extends Model
{
    public function scopedescripcion($query,$search)
    {
        if($search){
            return $query->where('descripcion', 'LIKE', "%$search%");}
        
    
    }
}
