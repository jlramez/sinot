<?php

namespace App;
use App\asigna_actuaciones;

use Illuminate\Database\Eloquent\Model;

class Actuacion extends Model
{
    public function asigna_actuacions()
	{

		return $this->belongs(asigna_actuacion::class);

	}

	public function scopeNombre($query,$search)
{
	if($search){
		return $query->where('Nombre', 'LIKE', "%$search%");}
	

}
}
