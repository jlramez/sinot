<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\juicio;

class JuicioController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth');

    }
	public function index(request $request)
	{
		//$juicios=juicio::paginate(10);
		$descripcion=$request->get('search');
		$juicios=juicio::orderBy('id','ASC')
			->descripcion($descripcion)
			->paginate(10);

		return view('juicios/admin', compact('juicios'));

	}

	public function create()
	{

		return view('juicios.create');

	}


	public function store(Request $request)
	{

		//dd ($request->all());
		$validatedData= $request->validate([

		'descripcion' => 'required|min:7|max:255',
		'nomenclatura' => 'required|min:2|max:255'

		]);

		$juicio=new juicio();
		$juicio->descripcion= $validatedData['descripcion'];
		$juicio->nomenclatura= $validatedData['nomenclatura'];
		$juicio->updated_at= now();
		$juicio->created_at= now();

		$juicio->save();
		$status="El registro se ha guardado correctamente";
		return back()->with(compact('status'));
	}

	public function show(areas $area)
	{

		return view('areas.show', compact('area'));


	}
	public function edit(juicio $juicio)
	{

		return view('juicios.edit', compact('juicio'));

	}


	public function update(Request $request, juicio $juicio)
	{
			
		//dd ($request->all());
		$validatedData= $request->validate([

            'descripcion' => 'required|min:7|max:255',
            'nomenclatura' => 'required|min:2|max:255'
    
            ]);
    
            
            $juicio->descripcion= $validatedData['descripcion'];
            $juicio->nomenclatura= $validatedData['nomenclatura'];
            $juicio->updated_at= now();
            $juicio->created_at= now();
    
            $juicio->save();
            $status="El registro se ha guardado correctamente";
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



	public function destroy(Request $request, juicio $juicio)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$juicio->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('admin_juicio');


	}

}
