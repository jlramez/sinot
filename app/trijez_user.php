<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trijez_user extends Model
{
    public function scopeNombre($query,$search)
    {
        if($search)
        dd($query);
            return $query
            ->where('name', 'LIKE', "%$search%");
    
    
    }
}
