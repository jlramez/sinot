<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\asignarolesandtareas;
use App\empleado;
use App\roles;
use App\expediente;
use App\asigna_expedientes;
use App\notificaciones;
use App\accesos;
use DateTimeInterface;


class User extends Authenticatable
{
    use Notifiable, asignarolesandtareas;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','roles_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
	{

		return $this->belongsToMany(roles::class,'asigna_roles','users_id');

    }
    public function empleados()
	{

		return $this->belongsTo(empleado::class);

	}

    /*public function expedientes()
	{

		return $this->belongsToMany(expediente::class,'asigna_expedientes','expedientes_id');

	}*/

    
    /*public function expedientes()
	{

		return $this->belongsToMany(expediente::class,'asigna_expedientes','users_id');

    }*/

    public function asigna_roles()
	{

		return $this->belongsTo(asigna_roles::class);

	}

    

	public function expedientes()
	{

		return $this->belongsToMany(expediente::class,'asigna_expedientes','users_id','expedientes_id');
        

	}
   public function asigna_expedientes()
	{

		return $this->belongsTo(asigna_expedientes::class);

	}

    
  
    public function adminlte_image()
    {
        return 'https:////picsum.photos/300/300';

    }

    public function adminlte_desc()
    {

         return $this->roles->first()->descripcion;   

    }

    public function adminlte_profile_url()
    {

        return '/usuarios/admin';
    }
  
    public function scopename($query,$search)
    {
        if($search)
        dd($query);
            return $query
            ->where('id', 'LIKE', "%$search%");
    
    
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function notificaciones()
	{

		return $this->belongsTo(notificaciones::class);

	}
    public function accesos()
	{

		return $this->belongsTo(accesos::class);

	}
}
