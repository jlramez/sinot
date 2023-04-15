<?php

namespace App\Traits;
use App\roles;
use App\tareas;
use App\user;
use App\asigna_roles;
use Illuminate\Support\Facades\DB;

trait asignarolesandtareas
{

    public function tareas()
	{

		return $this->belongsToMany(tareas::class,'asigna_tareas');

	}

    public function roles()
	{

		return $this->belongsToMany(roles::class,'asigna_tareas');

	}


   public function tareas_asignadas($role)
   {
		
		
			//dd($role, $this->roles->contains('slug', $role));
			if($this->roles->contains('slug', $role))
			{	  
				
				return true;
			}
			  
			return false;
		
   }
}