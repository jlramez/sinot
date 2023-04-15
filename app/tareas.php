<?php

namespace App;
use App\asigna_tareas;

use Illuminate\Database\Eloquent\Model;

class tareas extends Model
{
    public function asigna_tareas()
	{

		return $this->belongsTo(asigna_tareas::class);

	}
	public function roles()
	{

		return $this->belongsToMany(roles::class,'asigna_tareas');

	}

}
