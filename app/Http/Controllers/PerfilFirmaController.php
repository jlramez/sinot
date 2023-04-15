<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\perfilfirma;

class PerfilFirmaController extends Controller
{
    public function __construct()
    {

    	$this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
	{
		
		//$roles=roles::with('tareas')->select('descripcion')->distinct()->paginate(100);
		//$roles=roles::with('tareas')->select('descripcion')->distinct()->paginate(10);
		$perfilfirma=perfilfirma::with('empleados')->paginate(10);
		//dd($roles);
		//$id_roles=roles::all('id');
		//dd($roles2);
		return view('perfilfirma/admin', compact('perfilfirma'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
		return view('perfilfirma.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
                    $perfilfirma=new perfilfirma();
                    $perfilfirma->descripcion= $validatedData['descripcion'];
                    $perfilfirma->slug = strtolower($request->slug);
                    //$value=$valor;
                    //$roles->tareas_id= $value;
                    $perfilfirma->updated_at= now();
                    $perfilfirma->created_at= now();
                    $perfilfirma->save();
            
            //}		
                $status="El registro se ha guardado correctamente";
            return back()->with(compact('status'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(perfilfirma $perfilfirma)
    {
        return view('perfilfirma.edit', compact('perfilfirma'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, perfilfirma $perfilfirma)
    {
        //dd ($request->all());
		$validatedData= $request->validate([

            'descripcion' => 'required|min:4|max:255',
            //'nomenclatura' => 'required|min:2|max:255'
    
            ]);
    
                     
            $perfilfirma->descripcion= $validatedData['descripcion'];
            //$rol->nomenclatura= $validatedData['nomenclatura'];
            $perfilfirma->updated_at= now();
            //$rol->created_at= now();
            $perfilfirma->save();
            
            $status="El registro se ha actualizado correctamente";
            return back()->with(compact('status'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(perfilfirma $perfilfirma )
    {
        $perfilfirma = perfilfirma::find($perfilfirma->id);
        $perfilfirma->delete();
		$status="El registro se ha eliminado correctamente";
		return back()->with(compact('status'));
		
    }
}
