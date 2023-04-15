<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use App\empleado;
use App\asigna_firmantes;


class PerfilFirma extends Model
{
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function empleados()
	{

		return $this->belongsToMany(empleado::class,'asigna_firmantes','perfil_firma_id','empleados_id');

	}
    public function asigna_firmantes()
	{

		return $this->belongsTo(asigna_firmantes::class);

	}
}
