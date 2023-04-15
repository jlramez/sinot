<?php

namespace App;
use App\puestos;
use App\perfilfirma;
use DateTimeInterface;

use Illuminate\Database\Eloquent\Model;

class empleado extends Model
{
    
	public function puestos()
	{

		return $this->belongsTo(puestos::class);

	}
	public function areas()
	{

		return $this->belongsTo(areas::class);

	}

	public function perfilfirma()
	{

		return $this->belongsToMany(perfilfirma::class,'asigna_firmantes','empleados_id'.'perfil_firma_id');

	}
	//Query scope

public function scopeNombre($query,$search)
{
	if($search)
		return $query->where('nombre', 'LIKE', "%$search%")
				->orwhere('ap', 'LIKE', "%$search%")
				->orwhere('am', 'LIKE', "%$search%");


}
public function scopeAp($query,$search)
{
	if($ap)
		return $query->where('ap', 'LIKE', "%$ap%");


}
public function scopeAm($query,$search)
{
	if($am)
		return $query->where('am', 'LIKE', "%$am%");


}

protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
	
}

