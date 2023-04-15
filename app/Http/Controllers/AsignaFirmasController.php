<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\perfilfirma;
use Illuminate\Support\Facades\DB;
use App\empleado;
use App\asigna_firmantes;

class AsignaFirmasController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(perfilfirma $perfilfirma)
    {
        $rse=empleado::where('firma',1)->get();
		return view('asigna_firmante.create', compact('perfilfirma','rse'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, perfilfirma $perfilfirma, asigna_firmantes $af)
    {
       // dd($request);
        $empleados_id=$request->empleados_id;
		$perfilfirma_id=$perfilfirma->id;
       // dd($request, $perfilfirma_id->id);
		
		foreach($empleados_id as $empleados_id=>$valor)
		{
			$validatedData= $request->validate([
				//'descripcion' => 'required|min:7|max:255',
				//'roles_id' => 'required',
				'empleados_id' => 'required'
				]);
				//dd($asigna);
				$af=new asigna_firmantes();
			
				$af->perfil_firma_id= $perfilfirma_id;
				$value=$valor;
				$af->empleados_id= $value;
				//$af->activo=0;
				$af->updated_at= now();
				$af->created_at= now();
				$af->save();
		
		}		
			$status="El registro se ha guardado correctamente";
		return back()->with(compact('status'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(perfilfirma $perfilfirma)
    {
        $id_perfilfirma=$perfilfirma->id;
		//dd($id_perfilfirma);
        $af=asigna_firmantes::with('empleados','perfilfirma')->where('perfil_firma_id', $id_perfilfirma)->get();
        //dd($af[0]->empleados->nombre);
		/*$af=DB::select('SELECT empleados.nombre,ampleados.ap,ampleados.am,perfil_firmas.descripcion, asigna_firmantes.id as id   
		FROM asigna_firmantes,perfil_firmas,empleados WHERE asigna_firmantes.perfil_firma_id='.$id_perfilfirma.' 
		and perfil_firmas.id=asigna_firmantes.perfil_firma_id ');
		//$at=tareas::with('roles')->paginate();*/
		//dd($at);
		return view('asigna_firmante.show', compact('perfilfirma','af'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(asigna_firmantes $perfilfirma)
    {
       
	
        //dd ($perfilfirma->perfil_firma_id);
		//$area->$area::find($id);
		$perfilfirma->delete();
		//Flash::warning('El área ha sido eliminada');
		//return redirect()->route('admin_area');

	    /*$this->emit('sweet-alert', 'la información se borro correctamente');
        $this->resetPage();*/
		$status="El registro se ha eliminado correctamente";
		//return back()->with(compact('status'));
		return redirect()->route('show_addsign',$perfilfirma->perfil_firma_id);


	
    }
}
