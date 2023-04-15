<?php

namespace App;
use App\asigna_actuaciones;
use App\asigna_notificaciones;
use App\buzones;
use App\user;

use Illuminate\Database\Eloquent\Model;

class notificaciones extends Model
{
    public function asigna_actuaciones()
	{

		return $this->belongsTo(asigna_actuaciones::class);

	}

	public function asigna_notificaciones()
	{

		return $this->hasmany(asigna_notificaciones::class,'notificaciones_id');

	}
    public function buzones()
	{

		return $this->belongsToMany(buzones::class,'asigna_notificaciones');

	}
	

	public function scopeCreated_at($query,$search)
	{
		if($search)
			{
			return $query->where('created_at', 'LIKE', "%$search%");
			

			}
		

	}

	public function users()
	{

		return $this->belongsTo(user::class);

	}
}
