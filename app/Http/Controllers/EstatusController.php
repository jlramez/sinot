<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\estatus;

class EstatusController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth');

    }
	public function index(request $request)
	{
		//$estatus=estatus::paginate(10);
		$descripcion=$request->get('search');
		$estatus=estatus::orderBy('id','ASC')
			->descripcion($descripcion)
			->paginate(10);
		return view('estatus/admin', compact('estatus'));

    }
    
    public function create()
	{

		return view('estatus.create');

	}


	public function store(Request $request)
	{

		//dd ($request->all());
		$validatedData= $request->validate([

		'descripcion' => 'required|min:7|max:255',
		

		]);

		$estatus=new estatus();
		$estatus->descripcion= $validatedData['descripcion'];	
		$estatus->updated_at= now();
		$estatus->created_at= now();

		$estatus->save();
		$status="El registro se ha guardado correctamente";
		return back()->with(compact('status'));
	}
    public function show(estatus $estatus)
	{

		return view('estatus.show', compact('estatus'));


    }

    public function edit(estatus $estatus)
	{

		return view('estatus.edit', compact('estatus'));

	}


	public function update(Request $request, estatus $estatus)
	{
			
		//dd ($request->all());
		$validatedData= $request->validate([

		'descripcion' => 'required|min:5|max:255',
	

		]);

		 		
		$estatus->descripcion= $validatedData['descripcion'];
		$estatus->updated_at= now();
		$estatus->created_at= now();
		$estatus->save();
		
        $status="El registro se ha actualizado correctamente";
		return back()->with(compact('status'));
		
	}


    public function destroy(Request $request, estatus $estatus)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$estatus->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('admin_tarea');


	}

}
