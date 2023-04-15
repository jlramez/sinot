<?php

namespace App\Http\Controllers;
use App\areas;
use Illuminate\Http\Request;
use Illuminate\Http\Flash;
use \Component;


class AreasController extends Controller
{
    
    public function __construct()
    {

    	$this->middleware('auth');

    }
	public function index(Request $request)
	{
		//dd($request);
		//$areas=areas::paginate(10);
		$descripcion=$request->get('search');
		$areas=areas::orderBy('id','ASC')
			->descripcion($descripcion)
			->paginate(10);

		return view('areas/admin', compact('areas'));

	}

	public function create()
	{

		return view('areas.create');

	}


	public function store(Request $request)
	{

		//dd ($request->all());
		$validatedData= $request->validate([

		'descripcion' => 'required|min:7|max:255',
		'nomenclatura' => 'required|min:3|max:255'

		]);

		$areas=new areas();
		$areas->descripcion= $validatedData['descripcion'];
		$areas->nomenclatura= $validatedData['nomenclatura'];
		$areas->updated_at= now();
		$areas->created_at= now();

		$areas->save();
		$status="El registro se ha guardado correctamente";
		return back()->with(compact('status'));
	}

	public function show(areas $area)
	{

		return view('areas.show', compact('area'));


	}
	public function edit(areas $area)
	{

		return view('areas.edit', compact('area'));

	}


	public function update(Request $request, areas $area)
	{
			
		//dd ($request->all());
		$validatedData= $request->validate([

		'descripcion' => 'required|min:7|max:255',
		'nomenclatura' => 'required|min:2|max:255'

		]);

		 		
		$area->descripcion= $validatedData['descripcion'];
		$area->nomenclatura= $validatedData['nomenclatura'];
		$area->updated_at= now();
		$area->created_at= now();
		$area->save();
		
        $status="El registro se ha actualizado correctamente";
		return back()->with(compact('status'));
		
	}

	public function delete(Request $request, areas $area)
	{
	
        //dd ($request->all());
		$area->delete();

	    $this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();
		/*$status="El registro se ha eliminado correctamente";
		return back()->with(compact('status'));*/


	}



	public function destroy(Request $request, areas $area)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$area->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('admin_area');


	}

}
