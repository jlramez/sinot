<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\actuacion;
use Illuminate\Support\Facades\Gate;
class ActuacionController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth');

    }
	public function index(Request $request)
	{

		$nombre=$request->get('search');
		$actuaciones=actuacion::orderBy('id','ASC')
			->nombre($nombre)
			->paginate(10);

		//$actuaciones=actuacion::paginate(10);

		return view('actuaciones/admin', compact('actuaciones'));

    }
    
    public function create()
	{

		return view('actuaciones.create');

	}


	public function store(Request $request)
	{

		//dd ($request->all());
		$validatedData= $request->validate([

		'Nombre' => 'required|min:7|max:255',
		

		]);

		$actuaciones=new actuacion();
		$actuaciones->Nombre= $validatedData['Nombre'];	
		$actuaciones->updated_at= now();
		$actuaciones->created_at= now();

		$actuaciones->save();
		$status="El registro se ha guardado correctamente";
		return back()->with(compact('status'));
	}
    public function show(actuacion $actuacion)
	{

		return view('actuaciones.show', compact('actuacion'));


    }

    public function edit(actuacion $actuacion)
	{

		return view('actuaciones.edit', compact('actuacion'));

	}


	public function update(Request $request, actuacion $actuacion)
	{
		/*if(gate::allows('admin')){

			dd('El usuario es administrador');
		}
		else{

			dd('El usuario NO es administrador');
		}*/
		//dd ($request->all());
		$validatedData= $request->validate([

		'Nombre' => 'required|min:5|max:255',
	

		]);

		 		
		$actuacion->Nombre= $validatedData['Nombre'];
		$actuacion->updated_at= now();
		$actuacion->created_at= now();
		$actuacion->save();
		
        $status="El registro se ha actualizado correctamente";
		return back()->with(compact('status'));
		
	}


    public function destroy(Request $request, actuacion $actuacion)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$actuacion->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('admin_actuacion');


	}

}
