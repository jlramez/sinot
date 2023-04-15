<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\roles;
use App\tareas;
use App\asigna_tareas;
use Illuminate\Support\Facades\DB;


class RolesController extends Controller
{
    
    public function __construct()
    {

    	$this->middleware('auth');

    }
	public function index(request $request)
	{
		
		//$roles=roles::with('tareas')->select('descripcion')->distinct()->paginate(100);
		//$roles=roles::with('tareas')->select('descripcion')->distinct()->paginate(10);
		$descripcion=$request->get('search');
		$roles=roles::with('tareas')
		->orderBy('id','ASC')
		->descripcion($descripcion)
		->paginate(10);
	

		//dd($roles);
		//$id_roles=roles::all('id');
		//dd($roles2);
		return view('roles/admin', compact('roles'));

	}

	public function create(roles $rol)
	{
		$rst=tareas::all();
		return view('roles.create', compact('rol','rst'));

	}

	public function store(Request $request)
	{
		//dd($request);
		//$tareas_id=$request->tareas_id;
		
		
		//foreach($tareas_id as $id=>$valor)
		//{
				$validatedData= $request->validate([
				'descripcion' => 'required|min:4|max:255',
				//'tareas_id' => 'required'
				]);
				$roles=new roles();
				$roles->descripcion= $validatedData['descripcion'];
				$roles->slug = strtolower($request->slug);
				//$value=$valor;
				//$roles->tareas_id= $value;
				$roles->updated_at= now();
				$roles->created_at= now();
				$roles->save();
		
		//}		
			$status="El registro se ha guardado correctamente";
		return back()->with(compact('status'));
	}

	public function edit(roles $roles)
	{

		return view('roles.edit', compact('roles'));

	}


	public function update(Request $request, roles $roles)
	{
			
		//dd ($request->all());
		$validatedData= $request->validate([

		'descripcion' => 'required|min:4|max:255',
		//'nomenclatura' => 'required|min:2|max:255'

		]);

		 		
		$roles->descripcion= $validatedData['descripcion'];
		$roles->slug = strtolower($request->slug);
		//$rol->nomenclatura= $validatedData['nomenclatura'];
		$roles->updated_at= now();
		//$rol->created_at= now();
		$roles->save();
		
        $status="El registro se ha actualizado correctamente";
		return back()->with(compact('status'));
		
	}


	public function show(roles $roles, asigna_tareas $at)
	{
		$id_rol=$rol->id;
		$at=DB::select('SELECT tareas.descripcion, asigna_tareas.activo as status, asigna_tareas.id as id   FROM asigna_tareas,tareas WHERE asigna_tareas.roles_id='.$id_rol.' and tareas.id=asigna_tareas.tareas_id ');

		
		return view('roles.show', compact('roles','at'));

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



	public function destroy(Request $request, roles $roles)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$roles->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('admin_rol');


	}

	
	

}


