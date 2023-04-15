<?php

namespace App;
use App\actuacion;
use App\asigna_actuaciones;
use App\perfilfirma;
use App\efirma;

use Illuminate\Database\Eloquent\Model;

class documentos extends Model
{
    public function actuaciones()
	{

		return $this->belongsTo(actuacion::class);

	}
	public function asigna_actuaciones()
	{

		return $this->belongsto(asigna_actuaciones::class);

	}
	public function perfil_firmas()
	{

		return $this->belongsTo(perfilfirma::class);

	}
	
}
