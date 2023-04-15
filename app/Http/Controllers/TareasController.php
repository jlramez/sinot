<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tareas;

class TareasController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth');

    }
	public function index()
	{
		$tareas=tareas::paginate(10);

		return view('tareas/admin', compact('tareas'));

    }
    
    public function create()
	{

		return view('tareas.create');

	}


	public function store(Request $request)
	{

		//dd ($request->all());
		$validatedData= $request->validate([

		'descripcion' => 'required|min:7|max:255',
		

		]);

		$tareas=new tareas();
		$tareas->descripcion= $validatedData['descripcion'];	
		$tareas->updated_at= now();
		$tareas->created_at= now();

		$tareas->save();
		$status="El registro se ha guardado correctamente";
		return back()->with(compact('status'));
	}
    public function show(tareas $tarea)
	{

		return view('tareas.show', compact('tarea'));


    }

    public function edit(tareas $tarea)
	{

		return view('tareas.edit', compact('tarea'));

	}


	public function update(Request $request, tareas $tarea)
	{
			
		//dd ($request->all());
		$validatedData= $request->validate([

		'descripcion' => 'required|min:5|max:255',
	

		]);

		 		
		$tarea->descripcion= $validatedData['descripcion'];
		$tarea->updated_at= now();
		$tarea->created_at= now();
		$tarea->save();
		
        $status="El registro se ha actualizado correctamente";
		return back()->with(compact('status'));
		
	}


    public function destroy(Request $request, tareas $tarea)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$tarea->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('admin_tarea');


	}

}
