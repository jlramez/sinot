<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\asigna_documentos;

class AsignaDocumentosController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth');

    }
    public function destroy(Request $request, asigna_documentos $ad)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$ad->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		return back()->with(compact('status'));
		//return redirect()->route('destroy_add_docs',$ad->id);


	}
}
