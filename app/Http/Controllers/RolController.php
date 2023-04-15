<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rol;
use App\tareas;
use App\asigna_tareas;
use Illuminate\Support\Facades\DB;


class RolController extends Controller
{
    
    public function __construct()
    {

    	$this->middleware('auth');

    }
	public function index()
	{
		
		//$roles=roles::with('tareas')->select('descripcion')->distinct()->paginate(100);
		//$roles=roles::with('tareas')->select('descripcion')->distinct()->paginate(10);
		$rols=rol::paginate(10);
		//dd($roles);
		//$id_roles=roles::all('id');
		//dd($roles2);
		return view('roles/admin', compact('rols'));

	}

	public function create(rol $rol)
	{
		$rst=tareas::all();
		return view('roles.create', compact('rol','rst'));

	}

	public function store(Request $request)
	{
		
		//$tareas_id=$request->tareas_id;
		
		
		//foreach($tareas_id as $id=>$valor)
		//{
				$validatedData= $request->validate([
				'descripcion' => 'required|min:7|max:255',
				//'tareas_id' => 'required'
				]);
				$rol=new rol();
				$rol->descripcion= $validatedData['descripcion'];
				//$value=$valor;
				//$roles->tareas_id= $value;
				$rol->updated_at= now();
				$rol->created_at= now();
				$rol->save();
		
		//}		
			$status="El registro se ha guardado correctamente";
		return back()->with(compact('status'));
	}

	public function edit(rol $rol)
	{

		return view('roles.edit', compact('rol'));

	}


	public function update(Request $request, rol $rol)
	{
			
		//dd ($request->all());
		$validatedData= $request->validate([

		'descripcion' => 'required|min:7|max:255',
		//'nomenclatura' => 'required|min:2|max:255'

		]);

		 		
		$rol->descripcion= $validatedData['descripcion'];
		//$rol->nomenclatura= $validatedData['nomenclatura'];
		$rol->updated_at= now();
		$rol->created_at= now();
		$rol->save();
		
        $status="El registro se ha actualizado correctamente";
		return back()->with(compact('status'));
		
	}


	public function show(rol $rol, asigna_tareas $at)
	{
		$id_rol=$rol->id;
		$at=DB::select('SELECT tareas.descripcion, asigna_tareas.activo as status, asigna_tareas.id as id   FROM asigna_tareas,tareas WHERE asigna_tareas.rols_id='.$id_rol.' and tareas.id=asigna_tareas.tareas_id ');

		
		return view('roles.show', compact('rol','at'));

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



	public function destroy(Request $request, rol $rol)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$rol->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('admin_rol');


	}

	
	

}


