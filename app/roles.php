<?php

namespace App;
use App\tareas;
use App\asigna_tareas;
use App\DB;
use App\user;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
   /* public function asigna_tareas()
	{

		return $this->belongsTo(asigna_tareas::class);

	}*/

	public function usuarios()
	{

		return $this->belongsToMany(user::class,'asigna_roles','users_id');

	}

	
	public function tareas()
	{

		return $this->belongsToMany(tareas::class,'asigna_tareas');

	}

	public function scopedescripcion($query,$search)
    {
        if($search){
            return $query->where('descripcion', 'LIKE', "%$search%");
          }
        
    
    }

}
