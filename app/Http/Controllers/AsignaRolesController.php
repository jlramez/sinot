<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\asigna_tareas;
use App\asigna_roles;
use App\roles;
use Illuminate\Support\Facades\DB;

class AsignaRolesController extends Controller
{
	public function __construct()
    {

    	$this->middleware('auth');

    }
	public function create(user $usuario, roles $roles)
	{
		$rsr=roles::all();
		return view('asigna_roles.create', compact('usuario','rsr'));

	}

	public function store(Request $request, roles $roles, asigna_roles $ar,user $usuario)
	
	{
		$roles_id=$request->roles_id;
		$usuario_id=$usuario->id;
		//dd($rol->id);
		
		foreach($roles_id as $roles_id=>$valor)
		{
			$validatedData= $request->validate([
				//'descripcion' => 'required|min:7|max:255',
				//'roles_id' => 'required',
				'roles_id' => 'required'
				]);
				//dd($asigna);
				$ar=new asigna_roles();
			
				$ar->users_id=$usuario_id;
				$ar->roles_id= $roles->id;
				$value=$valor;
				$ar->roles_id= $value;
				$ar->activo=0;
				$ar->updated_at= now();
				$ar->created_at= now();
				$ar->save();
		
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

	public function show(user $usuario, asigna_roles $ar)
	{
		$id_user=$usuario->id;
		//dd($id_user);
		$ar=asigna_roles::with('roles')->
		where('users_id',$id_user)->paginate();
		//dd($ar);

		return view('asigna_roles.show', compact('usuario','ar'));

	}

	public function destroy(Request $request, asigna_roles $ar)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$ar->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('show_addrol',$ar->users_id);


	}
}
