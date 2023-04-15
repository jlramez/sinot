<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\empleado;
use App\puestos;
Use Alert;

class EmpleadoController extends Controller
{
      public function __construct()
    {

    	$this->middleware('auth');

    }
	
	public function index(Request $request )
	{
		$nombre=$request->get('search');
		$empleados=empleado::orderBy('id','ASC')
			->nombre($nombre)
			->paginate(10);

		//$empleados=empleado::with('puestos')->paginate(10);
		//dd($empleados);
		
		return view('empleados.admin', compact('empleados'));

	}
	public function show(empleado $empleado)
	{
		
		return view('empleados.show', compact('empleado'));


	}

	public function create(empleado $empleados)
	{
		$rsp=puestos::all();
		return view('empleados.create', compact('rsp'));

	}



	public function store(Request $request)
	{
			
		//dd ($request->all());
		$validatedData= $request->validate([

		'nombre' => 'required|min:3|max:255',
		'ap' => 'required|min:2|max:255',
		'ap' => 'required|min:2|max:255',
		'am' => 'required|min:2|max:255',
		'magistrado' => 'required|min:1|max:255',
		'curp' => 'required|min:2|max:255',
		'rfc' => 'required|min:2|max:255',
		'puestos_id' => 'required',
		'email' => 'required|min:2|max:255'

		]);
		$empleado=new empleado();
		$empleado->nombre= $validatedData['nombre'];
		$empleado->ap= $validatedData['ap'];
		$empleado->am= $validatedData['am'];
		$empleado->magistrado= $validatedData['magistrado'];
		$empleado->curp= $validatedData['curp'];
		$empleado->rfc= $validatedData['rfc'];
		$empleado->puestos_id= $validatedData['puestos_id'];
		$empleado->email= $validatedData['email'];
		$empleado->updated_at= now();
		$empleado->created_at= now();
		$empleado->save();
		
        $status="El registro se ha insertado correctamente";
		return back()->with(compact('status'));
		
	}

	public function edit(empleado $empleado)
	{

		$rsp=puestos::all();
		return view('empleados.edit', compact('empleado', 'rsp'));

	}


	public function update(Request $request, empleado $empleado)
	{
			
		//dd ($request->all());
		$validatedData= $request->validate([

		'nombre' => 'required|min:3|max:255',
		'ap' => 'required|min:2|max:255',
		'ap' => 'required|min:2|max:255',
		'am' => 'required|min:2|max:255',
		'magistrado' => 'required|min:1|max:255',
		'curp' => 'required|min:2|max:255',
		'rfc' => 'required|min:2|max:255',
		'puestos_id' => 'required',
		'email' => 'required|min:2|max:255'

		]);

		$empleado->nombre= $validatedData['nombre'];
		$empleado->ap= $validatedData['ap'];
		$empleado->am= $validatedData['am'];
		$empleado->magistrado= $validatedData['magistrado'];
		$empleado->curp= $validatedData['curp'];
		$empleado->rfc= $validatedData['rfc'];
		$empleado->puestos_id= $validatedData['puestos_id'];
		$empleado->email= $validatedData['email'];
		$empleado->updated_at= now();
		$empleado->created_at= now();
		$empleado->save();


		//Alert::success('Success Title', 'Success Message');		
        $status="El registro se ha actualizado correctamente";
		return back()->with(compact('status'));
		
	}
	public function edit_firma(empleado $empleado)
	{
		return view('empleados.firma', compact('empleado'));

	}

	public function update_firma(empleado $empleado)
	{
 
		 $firma=$empleado->firma;
		 //dd($activo);
		 if($firma==1)
		 {
			 $firma=0;
		 //dd($activo);
			 $empleado->firma=$firma;
			 $empleado->save();
			 $como='desactivado';	
			 //dd($activo);
		 }	
		 elseif($firma==0)
		 {
			 $firma=1;
			 //dd($activo);
			 $empleado->firma=$firma;
			 $empleado->save();
			 $como='activado';		
			 //dd($activo);
		 }
 $status="El permiso de firmado se ha ". $como ." correctamente";
 
 return back()->with(compact('status'));
 
 
 
	}


	public function destroy(Request $request, empleado $empleado)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$empleado->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('admin_empleado');


	}
}
