<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\puestos;
use App\areas;

class PuestosController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }
      
	public function index(request $request)
	{
		//$puestos=puestos::with('areas')->paginate(10);
		$descripcion=$request->get('search');
		$puestos=puestos::with('areas')
			->orderBy('id','ASC')
			->descripcion($descripcion)
			->paginate(10);

		return view('puestos/admin', compact('puestos'));

	}

	public function show(puestos $puesto)
	{

		return view('puestos.show', compact('puesto'));


	}


	public function create(puestos $puesto)
	{
		$rsa=areas::all();
		return view('puestos.create', compact('rsa'));

	}


	public function store(Request $request)
	{

		//dd ($request->all());
		$validatedData= $request->validate([

		'descripcion' => 'required|min:7|max:255',
		'nomenclatura' => 'required|min:2|max:255',
		'areas_id' => 'required'

		]);

		$puestos=new puestos();
		$puestos->descripcion= $validatedData['descripcion'];
		$puestos->nomenclatura= $validatedData['nomenclatura'];
		$puestos->areas_id= $validatedData['areas_id'];
		$puestos->updated_at= now();
		$puestos->created_at= now();

		$puestos->save();
		$status="El registro se ha guardado correctamente";
		return back()->with(compact('status'));
	}



		public function edit(puestos $puesto)
	{

		$rsa=areas::all();
		return view('puestos.edit', compact('puesto', 'rsa'));

	}


	public function update(Request $request, puestos $puesto)
	{
			
		//dd ($request->all());
		$validatedData= $request->validate([

		'descripcion' => 'required|min:7|max:255',
		'nomenclatura' => 'required|min:2|max:255',
		'areas_id' => 'required'
		


		]);

		 		
		$puesto->descripcion= $validatedData['descripcion'];
		$puesto->nomenclatura= $validatedData['nomenclatura'];
		$puesto->areas_id= $validatedData['areas_id'];
		$puesto->updated_at= now();
		$puesto->created_at= now();
		$puesto->save();
		
        $status="El registro se ha actualizado correctamente";
		return back()->with(compact('status'));
		
	}


		public function destroy(Request $request, puestos $puesto)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$puesto->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('admin_puesto');


	}

	
}
