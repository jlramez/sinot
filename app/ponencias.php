<?php

namespace App;
use App\magistrados;
use App\expediente;
use DateTimeInterface;

use Illuminate\Database\Eloquent\Model;

class ponencias extends Model
{
    public function magistrados()
	{

		return $this->belongsTo(magistrados::class);

    }
    public function expedientes()
	{

		return $this->belongsTo(expediente::class);

    }
    public function scopedescripcion($query,$search)
    {
        if($search){
            return $query->where('descripcion', 'LIKE', "%$search%");
          }
        
    
    }
    protected function serializeDate(DateTimeInterface $date)
{
    return $date->format('Y-m-d H:i:s');
}

  }
