<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\magistrados;
use App\asigna_notificaciones;
use App\expediente;
use App\asigna_actuaciones;
use App\documentos;

class MagistradosController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth');

    }
	public function index(request $request)
	{
		//$magistrados=magistrados::paginate(10);
		$nombre=$request->get('search');
		$magistrados=magistrados::with('ponencias')->orderBy('id','ASC')
			->nombre($nombre)
			->paginate(10);


		return view('magistrados/admin', compact('magistrados'));

    }
    
    public function create()
	{

		return view('magistrados.create');

	}


	public function store(Request $request)
	{

		//dd ($request->all());
		$validatedData= $request->validate([

        'nombre' => 'required|min:3|max:255',
        'primerapellido' => 'required|min:3|max:255',
        'segundoapellido' => 'required|min:3|max:255'
		

		]);

		$magistrados=new magistrados();
        $magistrados->nombre= $validatedData['nombre'];
        $magistrados->primerapellido= $validatedData['primerapellido'];
        $magistrados->segundoapellido= $validatedData['segundoapellido'];
        $magistrados->activo= $request->activo;	
		$magistrados->updated_at= now();
		$magistrados->created_at= now();

		$magistrados->save();
		$status="El registro se ha almacenado correctamente";
		return back()->with(compact('status'));
	}
    public function show(magistrados $magistrado)
	{

		return view('magistrados.show', compact('magistrado'));


    }

    public function edit(magistrados $magistrado)
	{

		return view('magistrados.edit', compact('magistrado'));

	}


	public function update(Request $request, magistrados $magistrado)
	{
			
		//dd ($request->all());
		$validatedData= $request->validate([

            'nombre' => 'required|min:3|max:255',
            'primerapellido' => 'required|min:3|max:255',
            'segundoapellido' => 'required|min:3|max:255'
            
    
            ]);
    
            
            $magistrado->nombre= $validatedData['nombre'];
            $magistrado->primerapellido= $validatedData['primerapellido'];
            $magistrado->segundoapellido= $validatedData['segundoapellido'];
            $magistrado->activo= $request->activo;	
            $magistrado->updated_at= now();
            $magistrado->created_at= now();    
            $magistrado->save();
            $status="El registro se ha actualizado correctamente";
            return back()->with(compact('status'));
		
	}


	public function reporte(Request $request, asigna_notificaciones $an)
	{
		
		//$nombre=$request->get('search');
		/*$expedientes=expedientes::with('users')->orderBy('id','ASC')
			->nombre($nombre)
			->paginate(10);*/

	$aa=asigna_actuaciones::with('expedientes','asigna_documentos','documentos','notificaciones')
	->orderBy('id','ASC')
	->paginate(10);
	//dd($aa[0]->notificaciones);


		return view('magistrados/reporte', compact('aa'));
	}
	

    public function destroy(Request $request, magistrados $magistrado)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$magistrado->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('admin_magistrado');


	}

}

