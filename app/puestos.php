<?php

namespace App;
use App\areas;

use Illuminate\Database\Eloquent\Model;

class puestos extends Model
{
    public function areas()
	{

		return $this->belongsTo(areas::class);

	}
	public function scopedescripcion($query,$search)
    {
        if($search){
            return $query->where('descripcion', 'LIKE', "%$search%");
          }
        
    
    }
}
