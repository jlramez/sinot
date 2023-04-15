<?php

namespace App;
use App\tareas;
use App\asigna_tareas;
use App\DB;
use App\user;

use Illuminate\Database\Eloquent\Model;

class rol extends Model
{
    public function asigna_tareas()
	{

		return $this->belongsTo(asigna_tareas::class);

	}

	public function usuarios()
	{

		return $this->belongsTo(user::class);

	}

}
