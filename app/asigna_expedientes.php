<?php

namespace App;
use App\expediente;
use App\user;
use DateTimeInterface;

use Illuminate\Database\Eloquent\Model;

class asigna_expedientes extends Model
{
    public function users()
	{

		return $this->belongsTo(user::class);

	}
    public function expedientes()
	{

		return $this->belongsTo(expediente::class);

	}



}
