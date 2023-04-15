<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ponencias;

class magistrados extends Model
{
    public function ponencias()
	{

		return $this->belongsTo(ponencias::class);

    }
    public function scopenombre($query,$search)
    {
        if($search)
            return $query->where('nombre', 'LIKE', "%$search%")
                    ->orwhere('primerapellido', 'LIKE', "%$search%")
                    ->orwhere('segundoapellido', 'LIKE', "%$search%");
    
    
    }
    public function scopereporte($query,$search_reporte)
    {
        if($search_reporte)
            return $query->where('folio', 'LIKE', "%$search%")
                    ->orwhere('created_at', 'LIKE', "%$search%")
                    ->orwhere('ponencia', 'LIKE', "%$search%");
    
    
    }
}
