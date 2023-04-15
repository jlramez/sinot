<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class asigna_documentos extends Model
{
    protected $guarded = [];
    /*public function asigna_actuaciones()
	{

		return $this->belongsTo(asigna_actuaciones::class);

	}*/

	public function asigna_actuaciones()
	{

		return $this->belongsTo(asigna_actuaciones::class);
		//return $this->belongsTo(asigna_documentos::class,'asigna_actuaciones','asigna_actuaciones_id','id');

	}
}
