<?php

namespace App;
use App\interposicion;
use App\estatus;
use App\juicio;
use App\ponencias;
use app\user;
use App\asigna_actuaciones;
use App\asigna_expedientes;
use DateTimeInterface;

use Illuminate\Database\Eloquent\Model;

class expediente extends Model
{
    public function interposicion()
	{

		return $this->belongsTo(interposicion::class);

	}
	public function estatus()
	{

		return $this->belongsTo(estatus::class);

	}
	public function juicios()
	{

		return $this->belongsTo(juicio::class);

	}
	public function ponencias()
	{

		return $this->belongsTo(ponencias::class);

	}
	/*public function users()
	{

		return $this->belongsTo(User::class);

	}*/	
  
	public function users()
	{

		return $this->belongsToMany(user::class,'asigna_expedientes','expedientes_id','users_id');

	}

	
	
	public function scopeFolio($query,$search)
{
	if($search)
		return $query->where('folio', 'LIKE', "%$search%")
				->orwhere('actor', 'LIKE', "%$search%")
				->orwhere('fecha', 'LIKE', "%$search%");


}
protected function serializeDate(DateTimeInterface $date)
{
    return $date->format('Y-m-d H:i:s');
}


	
}
