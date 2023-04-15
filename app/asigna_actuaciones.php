<?php

namespace App;
use App\expediente;
use App\actuacion;
use App\notificaciones;
use App\User;
use App\asigna_documentos;
use App\asigna_actuaciones;
use App\documentos;
use App\certificaciones;

use Illuminate\Database\Eloquent\Model;

class asigna_actuaciones extends Model
{
    public function expedientes()
	{

		return $this->belongsTo(expediente::class);

	}
	public function actuacions()
	{

		return $this->belongsTo(actuacion::class);

	}

	public function user()
	{

		return $this->belongsTo(User::class);

	}

	public function asigna_documentos()
	{

		return $this->hasMany(asigna_documentos::class);
		//return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');

	}

	public function notificaciones()
	{

		return $this->hasmany(notificaciones::class);
		//return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');

	}

	
	public function documentos()
	{

		return $this->hasmany(documentos::class);

	}
	public function certificaciones()
	{
        return $this->hasmany(certificaciones::class);
	}

	
}
