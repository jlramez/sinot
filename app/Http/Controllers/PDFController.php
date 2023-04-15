<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\user;
use App\asigna_expedientes;
use App\roles;
use App\documentos;
use App\asigna_actuaciones;
use App\perfilfirma;
use App\asigna_firmantes;
use App\actuacion;
use App\efirma;
use App\certificaciones;
use QrCode;
use Illuminate\Support\Facades\DB;
class PDFController extends Controller
{
   public function __construct()
    {

    	$this->middleware('auth');

    }
    public function PDF(user $usuarios)
    {
        //dd($usuarios->id);
        $id_user=$usuarios->id;
        $id_expediente=asigna_expedientes::with('expedientes','users')->where('users_id',$id_user)->first();
        //$id_expediente=$usuarios->expedientes_id;//aqui falta savcar el parametro 
        if($id_expediente==NULL)
         {
            $status="El usuario seleccionado no tiene algún expediente asignado, por favor asigne uno";
				$type="alert alert-warning";				
				return back()->with(compact('status','type'));
         } 
        
        $asigna_expedientes=asigna_expedientes::with('expedientes','users')->where('users_id',$id_user)->get();
        $users=user::with('expedientes')->where('id',$id_user)->get();
        $expediente=DB::select('SELECT COUNT(*) as cuantos FROM asigna_expedientes WHERE expedientes_id='.$id_expediente->expedientes_id.' AND users_id='.$id_user);
        //dd($expediente[0]->cuantos);
        // $expediente=DB::select('SELECT COUNT(*) as cuantos FROM expedientes WHERE id='.$id_expediente);
        if($expediente[0]->cuantos)
         {
            $print_user_name=auth()->user()->name;
           //dd($users);   
            $pdf=PDF::loadview('PDF/usuario_01',compact('users','print_user_name','asigna_expedientes'));
            return $pdf->download('PDF/usuario_01.pdf');
         }
         else 
         {
            $usuarios=user::with('roles')->paginate(10);
            //dd($usuarios);		
            return view('usuarios.admin', compact('usuarios'));
         }    



    }

    public function actuacionesPDF(asigna_actuaciones $aa)
  {
         //dd("aqui vamos");
         //dd($aa);
         $asa=asigna_actuaciones::with('actuacions')->where('actuacions_id',$aa->actuacions_id)->first();
         $nombre_actuacion=$asa->actuacions->id;
         $folio=$asa->expedientes->folio;
         //dd($nombre_actuacion,$folio);
         /*$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890?#=";
                  $efirma = "";
                  //Reconstruimos la contraseña segun la longitud que se quiera
                  for($i=0;$i<50;$i++) 
                  {
                     //obtenemos un caracter aleatorio escogido de la cadena de caracteres
                     $efirma .= substr($str,rand(0,62),1);
                  }*/

         $documentos = documentos::with('asigna_actuaciones')->where('asigna_actuaciones_id',$aa->id)->first();
            if ($documentos)
            {
            $perfilfirma=$documentos->perfil_firmas_id;
            }
            else
            {
               $status="Primero, debe generar un documento ";
                           $type="alert alert-warning";	
                           //dd($type);			
                           return back()->with(compact('status','type'));	      
            }  
            $efrs=efirma::all()->where('documentos_id', $documentos->id)->first();
            if ($efrs)
            {             
               $efirma=$efrs->efirma;
            }
            else  {
               $efirma="";
            
                  }
         //dd($efirma);
         $rsaf=asigna_firmantes::with('empleados')->where('perfil_firma_id',  $perfilfirma)->get();
         $print_user_name=auth()->user()->name;
         foreach ($rsaf as $firma)
         {
         $nombres_firmantes[]=$firma->empleados->nombre;
         }
         //dd($perfilfirma,$nombres_firmantes, $efirma);
         $pdf = PDF::loadView('PDF/actuaciones', compact('documentos','perfilfirma','aa','print_user_name','rsaf','nombres_firmantes','efirma'));
         return $pdf->download($folio.'_'.$nombre_actuacion);

  } 

  public function cedulaPDF(certificaciones $certificacion)
  {

      //$certificacion = certificaciones::with('asigna_actuaciones')->get();
      //dd($certificacion);
      $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
      $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      $fecha=date('d')." DE ".strtoupper($meses[date('n')-1]). " DEL ".date('Y');
      //dd(date('d')." DE ".strtoupper($meses[date('n')-1]). " DEL ".date('Y'));
      //Salida: Miercoles 05 de Septiembre del 2016
     
      $pdf=PDF::loadview('PDF/cedula/cedula',compact('certificacion','fecha'));
      return $pdf->download('cedula.pdf');
  }
    public function PDFProductos(){

    	$productos = Producto::all();
    	$pdf = PDF::loadView('productos', compact('productos'));
    	return $pdf->download('productos.pdf');
    }

    public function PDFUsuario_01(){

    	$productos = Producto::all();
    	$pdf = PDF::loadView('productos', compact('productos'));
    	return $pdf->download('productos.pdf');
    }

    public function QR_generate()
    {
       QrCode::generate('http://trijez.mx', '../public/qrcodes/qrcode.svg');
    }
}
