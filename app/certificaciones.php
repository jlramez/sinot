<?php

namespace App;
use App\asigna_actuaciones;

use Illuminate\Database\Eloquent\Model;

class certificaciones extends Model
{
    protected $fillable = ['asigna_actuaciones_id','nombre_dcto','code_name','fojas','merge_dcto'];
    public function asigna_actuaciones()
	{
        return $this->belongsTo(asigna_actuaciones::class);
	}
}
