<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\roles;
use App\asigna_tareas;
use App\tareas;
use Illuminate\Support\Facades\DB;

class AsignaTareasController extends Controller
{
	public function __construct()
    {

    	$this->middleware('auth');

    }
	public function create(roles $roles)
	{
		$rst=tareas::all();
		return view('asigna_tareas.create', compact('roles','rst'));

	}

	public function store(Request $request, roles $roles, asigna_tareas $at)
	
	{
		$tareas_id=$request->tareas_id;
		//dd($rol->id);
		
		foreach($tareas_id as $tareas_id=>$valor)
		{
			$validatedData= $request->validate([
				//'descripcion' => 'required|min:7|max:255',
				//'roles_id' => 'required',
				'tareas_id' => 'required'
				]);
				//dd($asigna);
				$at=new asigna_tareas();
			
				$at->roles_id= $roles->id;
				$value=$valor;
				$at->tareas_id= $value;
				$at->activo=0;
				$at->updated_at= now();
				$at->created_at= now();
				$at->save();
		
		}		
			$status="El registro se ha guardado correctamente";
		return back()->with(compact('status'));

	}

	public function edit(asigna_tareas $at)
	{

	
		return view('asigna_tareas.edit', compact('at'));

	}
	
	
	public function update(asigna_tareas $at)
	
	{
		
				$activo=$at->activo;
				//dd($activo);
				if($activo==1)
				{
					$activo=0;
				//dd($activo);
					$at->activo=$activo;
					$at->save();
					$como='desactivado';	
					//dd($activo);
				}	
				elseif($activo==0)
				{
					$activo=1;
					//dd($activo);
					$at->activo=$activo;
					$at->save();
					$como='activado';		
					//dd($activo);
				}
			$status="El registro se ha ". $como ." correctamente";
		return back()->with(compact('status'));

	}

	public function show(roles $roles, asigna_tareas $at)
	{
		$id_rol=$roles->id;
		//dd($id_rol);
		$at=DB::select('SELECT tareas.descripcion, asigna_tareas.activo, asigna_tareas.id as id   
		FROM asigna_tareas,tareas WHERE asigna_tareas.roles_id='.$id_rol.' 
		and tareas.id=asigna_tareas.tareas_id ');
		//$at=tareas::with('roles')->paginate();
		//dd($at);
		return view('asigna_tareas.show', compact('roles','at'));

	}

	public function destroy(Request $request, asigna_tareas $at)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$at->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('show_addtask',$at->roles_id);


	}
}
