<?php

namespace App;
use APP\User;
use App\roles;

use Illuminate\Database\Eloquent\Model;

class asigna_roles extends Model
{
    public function users()
	{

		return $this->belongsTo(User::class);

	}
    public function roles()
	{

		return $this->belongsTo(roles::class);

	}
}
