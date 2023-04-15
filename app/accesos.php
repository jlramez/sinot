<?php

namespace App;
use App\user;

use Illuminate\Database\Eloquent\Model;

class accesos extends Model
{
    
	protected $fillable = ['id','user_id','ip','last_login'];
	public function user()
	{

		return $this->belongsTo(user::class);

	}
}
