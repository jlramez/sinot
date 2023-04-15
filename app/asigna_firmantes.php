<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use App\empleado;

class asigna_firmantes extends Model
{
    public function perfilfirma()
	{

		return $this->belongsTo(perfilfirma::class);

    }
    
    public function empleados()
	{

		return $this->belongsTo(empleado::class);

	}
	protected function serializeDate(DateTimeInterface $date)
	{
		return $date->format('Y-m-d H:i:s');
	}

}


