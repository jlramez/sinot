<?php

namespace App;
use App\documentos;

use Illuminate\Database\Eloquent\Model;

class efirma extends Model
{
    public function documentos()
	{

		return $this->belongsTo(documentos::class);

	}
}
