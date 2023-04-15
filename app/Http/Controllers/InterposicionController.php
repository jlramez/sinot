<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\interposicion;

class InterposicionController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth');

    }
	public function index(request $request)
	{
		//$interposiciones=interposicion::paginate(10);
		$descripcion=$request->get('search');
		$interposiciones=interposicion::orderBy('id','ASC')
			->descripcion($descripcion)
			->paginate(10);

		return view('interposiciones/admin', compact('interposiciones'));

    }
    
    public function create()
	{

		return view('interposiciones.create');

	}


	public function store(Request $request)
	{

		//dd ($request->all());
		$validatedData= $request->validate([

		'descripcion' => 'required|min:7|max:255',
		

		]);

		$interposicion=new interposicion();
		$interposicion->descripcion= $validatedData['descripcion'];	
		$interposicion->updated_at= now();
		$interposicion->created_at= now();

		$interposicion->save();
		$status="El registro se ha guardado correctamente";
		return back()->with(compact('status'));
	}
    public function show(interposicion $interposicion)
	{

		return view('interposiciones.show', compact('interposicion'));


    }

    public function edit(interposicion $interposicion)
	{

		return view('interposiciones.edit', compact('interposicion'));

	}


	public function update(Request $request, interposicion $interposicion)
	{
			
		//dd ($request->all());
		$validatedData= $request->validate([

		'descripcion' => 'required|min:5|max:255',
	

		]);

		 		
		$interposicion->descripcion= $validatedData['descripcion'];
		$interposicion->updated_at= now();
		$interposicion->created_at= now();
		$interposicion->save();
		
        $status="El registro se ha actualizado correctamente";
		return back()->with(compact('status'));
		
	}


    public function destroy(Request $request, interposicion $interposicion)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$interposicion->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('admin_tarea');


	}
}
