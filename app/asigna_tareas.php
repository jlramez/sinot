<?php

namespace App;
use App\roles;
use App\tareas;

use Illuminate\Database\Eloquent\Model;

class asigna_tareas extends Model
{
    public function roles()
	{

		return $this->belongsTo(roles::class);

    }
    
    public function tareas()
	{

		return $this->belongsTo(tareas::class);

	}
}
