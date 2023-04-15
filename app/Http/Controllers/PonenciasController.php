<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ponencias;
use App\magistrados;

class PonenciasController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth');

    }
	public function index(request $request)
	{
        
		//$ponencias=ponencias::with('magistrados')->paginate(10);
		$descripcion=$request->get('search');
		$ponencias=ponencias::orderBy('id','ASC')
			->descripcion($descripcion)
			->paginate(10);
        //dd($ponencias);        
		return view('ponencias/admin', compact('ponencias'));
    }
    
    public function create()
	{

        $rsm=magistrados::all()->where('activo',1);
        //dd($rsm);
        return view('ponencias.create',compact('rsm'));
        

	}


	public function store(Request $request)
	{

		//dd ($request->all());
		$validatedData= $request->validate([

        'descripcion' => 'required|min:3|max:255',
       
		

		]);

		$ponencias=new ponencias();
        $ponencias->descripcion= $validatedData['descripcion'];
        $ponencias->magistrados_id= $request->magistrado_id;
		$ponencias->updated_at= now();
		$ponencias->created_at= now();

		$ponencias->save();
		$status="El registro se ha almacenado correctamente";
		return back()->with(compact('status'));
	}
    public function show(ponencias $ponencia)
	{

        $magistrado = magistrados::where('id', $ponencia->magistrados_id)->get();
        //dd($magistrado);
        return view('ponencias.show', compact('ponencia','magistrado'));


    }

    public function edit(ponencias $ponencia)
	{
		$rsm=magistrados::all()->where('activo',1);
		return view('ponencias.edit', compact('ponencia','rsm'));

	}


	public function update(Request $request, ponencias $ponencia)
	{
			
	//dd ($request->all());
    $validatedData= $request->validate([

        'descripcion' => 'required|min:3|max:255',
       
		

		]);
        $ponencia->descripcion= $validatedData['descripcion'];
        $ponencia->magistrados_id= $request->magistrado_id;
		$ponencia->updated_at= now();
		$ponencia->created_at= now();
		$ponencia->save();
		$status="El registro se ha almacenado correctamente";
		return back()->with(compact('status'));
		
	}


    public function destroy(Request $request, ponencias $ponencia)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$ponencia->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('admin_ponencia');


	}

}
