<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\buzones;
use App\User;


class BuzonesController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth');

    }
	public function index()
	{
		
        $buzones=buzones::with('users')
		->where('users_id',auth()->user()->id)->paginate(10);
        //dd($buzones);		
		return view('buzones.admin',compact('buzones'));

    }
    public function create(buzones $buzones)
	{
		$rs_user=User::all();
		return view('buzones.create', compact('rs_user'));

	}



	public function store(Request $request)
	{
			
		//dd ($request->all());
		$validatedData= $request->validate([

		'descripcion' => 'required|min:7|max:255',
		

		]);
		$buzon=new buzones();
		$buzon->descripcion= $validatedData['descripcion'];
		$buzon->users_id=$request->usuario_id;
		$buzon->activo= $request->activo;		
		$buzon->updated_at= now();
		$buzon->created_at= now();
		$buzon->save();
		
        $status="El registro se ha insertado correctamente";
		return back()->with(compact('status'));
		
    }
    public function edit(buzones $buzon)
	{
        $rs_user=User::all();
		return view('buzones.edit', compact('buzon','rs_user'));

    }
    public function update(Request $request, buzones $buzon)
	{
			
		//dd ($request->all());
		$validatedData= $request->validate([

		'descripcion' => 'required|min:7|max:255',
		

		]);
		$buzon->descripcion= $validatedData['descripcion'];
		$buzon->users_id=$request->usuario_id;
		$buzon->activo= $request->activo;		
		$buzon->updated_at= now();
		$buzon->created_at= now();
		$buzon->save();
		
        $status="El registro se ha actualizado correctamente";
		return back()->with(compact('status'));
		
    }
    public function destroy(Request $request, buzones $buzon)
	{
	
        //dd ($request->all());
		//$area->$area::find($id);
		$buzon->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('admin_buzon');


	}
}
