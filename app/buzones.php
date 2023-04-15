<?php

namespace App;
use App\User;
use App\notificaciones;

use Illuminate\Database\Eloquent\Model;

class buzones extends Model
{
    public function users()
	{

        return $this->belongsTo(User::class);
    }
    public function notificaciones()
	{

		return $this->belongsToMany(notificaciones::class,'asigna_notificaciones');

	}
    public function scopeNombre($query,$search)
    {
        if($search)
            return $query->where('descripcion', 'LIKE', "%$search%");
    
    
    }

}
