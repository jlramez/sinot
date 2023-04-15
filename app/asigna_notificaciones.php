<?php

namespace App;
use App\notificaciones;
use App\buzones;
use App\actuacion;
use App\asigna_actuaciones;


use Illuminate\Database\Eloquent\Model;

class asigna_notificaciones extends Model
{
    public function buzones()
	{

		return $this->belongsTo(buzones::class);

	}
    public function notificaciones()
	{

		return $this->belongsTo(notificaciones::class,'notificaciones_id');

	}

	public function scopeCreated_at($queryan,$searchan)
	{
		if($searchan)
			{
				dd('busca');
			return $query->where('created_at', 'LIKE', "%$searchan%");
			}
		

	}
	/*protected function serializeDate(DateTimeInterface $date)
{
    return $date->format('Y-m-d H:i:s');
}*/
  
}
