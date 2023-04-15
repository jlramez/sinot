<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrijezTrijezUserController;
use App\Http\Controllers\AsignaRolesController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Storage;
use App\mail\NotificaMailable;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('notificacion', function () {
  $correo= new NotificaMailable;
  Mail::to('drill_2001@hotmail.com')->send($correo);

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('Auth/register', 'Auth/RegisterController@register')->name('register');


//ACCESOS
Route::get('/acceso/admin', 'AccesosController@index')->name('admin_acceso')->middleware('roles:admin');
Route::resource('accesos','AccesosController');

//FIN ACCESOS


//ACTUACIONES

Route::get('/actuacion/admin', 'ActuacionController@index')->name('admin_actuacion')->middleware('roles:admin');
Route::get('/actuacion/create', 'ActuacionController@create')->name('create_actuacion')->middleware('roles:admin');
Route::post('/actuacion', 'ActuacionController@store')->name('store_actuacion')->middleware('roles:admin');;
Route::get('/actuacion/{actuacion}/edit', 'ActuacionController@edit')->name('edit_actuacion')->middleware('roles:admin');
Route::put('/actuacion/{actuacion}', 'ActuacionController@update')->name('update_actuacion')->middleware('roles:admin');
Route::get('/actuacion/{actuacion}', 'ActuacionController@destroy')->name('destroy_actuacion')->middleware('roles:admin');

//FIN ACTUACIONES


//ÁREAS

Route::get('/areas/admin', 'AreasController@index')->name('admin_area')->middleware('roles:admin');
Route::get('/areas/create', 'AreasController@create')->name('create_area')->middleware('roles:admin');
Route::post('/areas', 'AreasController@store')->name('store_area')->middleware('roles:admin');;
Route::get('/areas/{area}/edit', 'AreasController@edit')->name('edit_area')->middleware('roles:admin');
Route::put('/areas/{area}', 'AreasController@update')->name('update_area')->middleware('roles:admin');
Route::get('/areas/{area}/show', 'AreasController@show')->name('show_area')->middleware('roles:admin');
Route::get('/areas/{area}', 'AreasController@delete')->name('delete_area')->middleware('roles:admin');
Route::get('/areas/{area}', 'AreasController@destroy')->name('destroy_area')->middleware('roles:admin');

//FIN AREAS



//ASIGNA ACTUACIONES

Route::get('addact/create/{expediente}', 'AsignaActuacionesController@create')->name('create_addact')->middleware('roles:admin,seceyc');
Route::post('/addact/{expediente}', 'AsignaActuacionesController@store')->name('store_addact')->middleware('roles:admin,seceyc');
Route::get('/asigna_actuaciones/{expediente}/show', 'AsignaActuacionesController@show_aa')->name('show_addact')->middleware('roles:admin,seceyc,actuario');
Route::get('/asigna_actuaciones/{aa}/edit', 'AsignaActuacionesController@edit')->name('edit_addact')->middleware('roles:admin,seceyc');
Route::put('/asigna_actuaciones/{aa}', 'AsignaActuacionesController@update')->name('update_addact')->middleware('roles:admin');
Route::get('/asigna_actuaciones/{aa}/edit_actuaciones', 'AsignaActuacionesController@edit_actuaciones')->name('edit_a_actuacion')->middleware('roles:admin,seceyc');
Route::put('/asigna_actuaciones/{aa}/edit_aa', 'AsignaActuacionesController@update_actuaciones')->name('update_a_actuacion')->middleware('roles:admin,seceyc');
Route::get('/asigna_actuaciones/show/{id_aa}', 'AsignaActuacionesController@show')->name('show_asigna_actuacion')->middleware('roles:admin,seceyc');//ojoooo
Route::get('/asigna_actuaciones/{aa}', 'AsignaActuacionesController@destroy')->name('destroy_addtask')->middleware('roles:admin');

//FIN ASIGNA ACTUACIONES


//ASIGNA_DOCUMENTOS

Route::get('/asigna_documentos/{ad}', 'AsignaDocumentosController@destroy')->name('destroy_add_docs')->middleware('roles:admin,seceyc');

//FIN ASIGNA_DOCUMENTOS

//ASIGNA EXPEDIENTES 

Route::get('addexp/create/{usuario}', 'AsignaExpedientesController@create')->name('create_addexp')->middleware('roles:admin,op');
Route::post('/addexp/{usuario}', 'AsignaExpedientesController@store')->name('store_addexp')->middleware('roles:admin,op');
Route::get('/addexp/{usuario}/show', 'AsignaExpedientesController@show')->name('show_addexp')->middleware('roles:admin,op');



//FIN ASIGNA EXPEDIENTES

// ASIGNA FIRMAS

Route::get('/asigna_firmas/{perfilfirma}/show', 'AsignaFirmasController@show')->name('show_addsign')->middleware('roles:admin');
Route::get('asigna_firmas/create/{perfilfirma}', 'AsignaFirmasController@create')->name('create_addsign')->middleware('roles:admin');
Route::post('/asigna_firmas/{perfilfirma}', 'AsignaFirmasController@store')->name('store_addsign')->middleware('roles:admin');
Route::get('/asigna_firmas/{perfilfirma}', 'AsignaFirmasController@destroy')->name('destroy_addsign')->middleware('roles:admin');

//FIN ASIGNA_FIRMAS


//ASIGNA TAREAS 

Route::get('addtask/create/{roles}', 'AsignaTareasController@create')->name('create_addtask')->middleware('roles:admin');
Route::post('/addtask/{roles}', 'AsignaTareasController@store')->name('store_addtask')->middleware('roles:admin');
Route::get('/asigna_tareas/{roles}/show', 'AsignaTareasController@show')->name('show_addtask')->middleware('roles:admin');
Route::get('/asigna_tareas/{at}/edit', 'AsignaTareasController@edit')->name('edit_addtask')->middleware('roles:admin');
Route::put('/asigna_tareas/{at}', 'AsignaTareasController@update')->name('update_addtask')->middleware('roles:admin');
Route::get('/asigna_tareas/{at}', 'AsignaTareasController@destroy')->name('destroy_addtask')->middleware('roles:admin');

//ASIGNA_NOTIFICACIONES

 Route::get('/asigna_notificaciones/self/{aa}','AsignaNotificacionesController@store_buzon')->name('store_notificacion_buzon_automatico')->middleware('roles:admin,actuario');
 
 Route::get('/asigna_notificaciones/{notificacion}/create', 'AsignaNotificacionesController@create')->name('create_addnot')->middleware('roles:admin');
 Route::post('/asigna_notificaciones/{notificacion}', 'AsignaNotificacionesController@store')->name('store_addnot')->middleware('roles:admin');
 Route::get('/asigna_notificaciones/{buzones}/show', 'AsignaNotificacionesController@show_an')->name('show_addnot')->middleware('roles:admin,magistrado,externo')->middleware('auth');
Route::get('/asigna_notificaciones/{an}', 'AsignaNotificacionesController@show')->name('show_cn')->middleware('roles:admin');
Route::get('/asigna_notificaciones/{an}/read', 'AsignaNotificacionesController@read')->name('read_addnot')->middleware('roles:admin,magistrado,externo');
Route::get('/asigna_notificaciones/{an}', 'AsignaNotificacionesController@destroy')->name('destroy_addnot')->middleware('roles:admin');


//FIN ASIGNA NOTIFICACIONES

// FIN ASIGNA TAREAS 

//ASIGNA ROLES 

Route::get('addrol/create/{usuario}', 'AsignaRolesController@create')->name('create_addrol')->middleware('roles:admin,op');
Route::post('/addrol/{usuario}', 'AsignaRolesController@store')->name('store_addrol')->middleware('roles:admin,op');
Route::get('/asigna_roles/{usuario}/show', 'AsignaRolesController@show')->name('show_addrol')->middleware('roles:admin,op');
Route::get('/asigna_roles/{ar}', 'AsignaRolesController@destroy')->name('destroy_addrol')->middleware('roles:admin');
// FIN ASIGNA ROLES 

//BUZONES

Route::get('/buzon/admin', 'BuzonesController@index')->name('admin_buzon')->middleware('auth','roles:externo,admin');
Route::get('/buzon/admin/{user}', 'BuzonesController@index')->name('admin_buzon_user')->middleware('roles:admin');
Route::get('/buzon/create', 'BuzonesController@create')->name('create_buzon')->middleware('roles:admin');
Route::post('/buzon', 'BuzonesController@store')->name('store_buzon')->middleware('roles:admin');
Route::get('/buzones/{buzon}/edit', 'BuzonesController@edit')->name('edit_buzon')->middleware('roles:admin,magistrado,externo');
Route::put('/buzones/{buzon}', 'BuzonesController@update')->name('update_buzon')->middleware('roles:admin,magistrado,externo');
Route::get('/buzones/{buzon}', 'BuzonesController@destroy')->name('destroy_buzon')->middleware('roles:admin');

//FIN BUZONES


//CERTIFICACIONES

Route::get('/certificacion/admin', 'CertificacionesController@index')->name('admin_certificacion')->middleware('auth','roles:admin,sga,actuario');
Route::get('/certificaciones/{aa}/create', 'CertificacionesController@create')->name('create_certificacion')->middleware('roles:admin,actuario');
Route::post('/certificaciones/{aa}', 'CertificacionesController@store')->name('store_cert')->middleware('roles:admin,actuario');
Route::get('/certificaciones/{certificaciones}/edit', 'CertificacionesController@edit')->name('edit_certificaciones')->middleware('roles:admin');
Route::put('/certificaciones/{certificaciones}', 'CertificacionesController@update')->name('update_certificaciones')->middleware('roles:admin');
Route::get('/certificaciones/{certificacion}/autorizar', 'CertificacionesController@autoriza')->name('autorizar_certificacion')->middleware('roles:admin,sga');
Route::get('/certificaciones/certificar/{certificacion}', 'CertificacionesController@certificar')->name('firma_certificaciones')->middleware('roles:admin');
Route::get('/show_cert/{certificacion}', 'CertificacionesController@show')->name('show_cert')->middleware('roles:admin');
Route::put('/certificaciones/autorizar/{certificacion}', 'CertificacionesController@modify_autoriza')->name('modify_autorizacion')->middleware('roles:admin');


//FIN CERTIFICACIONES

// DESTINATARIO

Route::get('/destinatario/admin', 'DestinatariosController@index')->name('admin_destinatario')->middleware('roles:admin');


//FIN DESTINATARIO

// DOCUMENTOS


Route::resource('documentos','DocumentosController');
Route::get('/documento/admin/', 'DocumentosController@index')->name('admin_dcto')->middleware('roles:admin,actuario');
Route::get('/documentos/{aa}/create', 'DocumentosController@create')->name('create_dcto')->middleware('roles:admin,actuario');
Route::get('/documentos/{documentos}/adjuntar', 'DocumentosController@adjuntar_dcto')->name('adjuntar_dcto')->middleware('roles:admin,actuario');
Route::put('/documentos/save/{documentos}', 'DocumentosController@save')->name('save_dcto')->middleware('roles:admin,actuario');
Route::post('/documentos/{aa}', 'DocumentosController@store')->name('store_dcto')->middleware('roles:admin,actuario');

//FIN 

//efirma
Route::resource('efirma','efirmaController');
Route::get('/documento/{documentos}/firmar', 'efirmaController@firmar')->name('efirma_dcto')->middleware('roles:admin,actuario');
//Route::post('/documento/{documentos}', 'BuzonesController@store')->name('store_buzon')->middleware('roles:admin');
//EFIRMA


//EMPLEADOS

Route::get('/empleados/admin', 'EmpleadoController@index')->name('admin_empleado')->middleware('roles:admin');
Route::get('/empleados/create', 'EmpleadoController@create')->name('create_empleado')->middleware('roles:admin');
Route::post('/empleados', 'EmpleadoController@store')->name('store_empleado')->middleware('roles:admin');
Route::get('/empleados/{empleado}/show', 'EmpleadoController@show')->name('show_empleado')->middleware('roles:admin');
Route::get('/empleados/{empleado}/edit', 'EmpleadoController@edit')->name('edit_empleado')->middleware('roles:admin');
Route::put('/empleados/{empleado}', 'EmpleadoController@update')->name('update_empleado')->middleware('roles:admin');
Route::get('/empleados/{empleado}', 'EmpleadoController@destroy')->name('destroy_empleado')->middleware('roles:admin');

//FIN EMPLEADOS

//ESTATUS


Route::get('/estatus/admin', 'EstatusController@index')->name('admin_estatus')->middleware('roles:admin');
Route::get('/estatus/create', 'EstatusController@create')->name('create_estatus')->middleware('roles:admin');
Route::post('/estatus', 'EstatusController@store')->name('store_estatus')->middleware('roles:admin');
Route::get('/estatus/{estatus}/show', 'EstatusController@show')->name('show_estatus')->middleware('roles:admin');
Route::get('/estatus/{estatus}/edit', 'EstatusController@edit')->name('edit_estatus')->middleware('roles:admin');
Route::put('/estatus/{estatus}', 'EstatusController@update')->name('update_estatus')->middleware('roles:admin');
Route::get('/empleados/{empleado}/firma', 'EmpleadoController@edit_firma')->name('edit_firma')->middleware('roles:admin');
Route::put('/empleados/firma/{empleado}', 'EmpleadoController@update_firma')->name('update_firma')->middleware('roles:admin');
Route::get('/estatus/{estatus}', 'EstatusController@destroy')->name('destroy_estatus')->middleware('roles:admin');

//FIN ESTATUS


//EXPEDIENTES

//Route::get('/expediente/admin', 'ExpedienteController@index')->name('admin_expediente');
Route::get('/expedientes/admin', 'ExpedienteController@index')->name('admin_expediente')->middleware('roles:admin,consulta,magistrado,op,seceyc,actuario');
Route::get('/expediente/create', 'ExpedienteController@create')->name('create_expediente')->middleware('roles:admin,op');
Route::post('/expediente', 'ExpedienteController@store')->name('store_expediente')->middleware('roles:admin,op');
Route::get('/expediente/{expediente}/show', 'ExpedienteController@show')->name('show_expediente')->middleware('roles:admin,op,seceyc');
Route::get('/expediente/{expediente}/edit', 'ExpedienteController@edit')->name('edit_expediente')->middleware('roles:admin,op');
Route::put('/expediente/{expediente}', 'ExpedienteController@update')->name('update_expediente')->middleware('roles:admin,op');
Route::get('/expediente/{expediente}', 'ExpedienteController@destroy')->name('destroy_expediente')->middleware('roles:admin');

//FIN EXPEDIENTE

//INTERPOSICIONES

Route::get('/interposicion/admin', 'InterposicionController@index')->name('admin_interposicion')->middleware('roles:admin');
Route::get('/interposicion/create', 'InterposicionController@create')->name('create_interposicion')->middleware('roles:admin');
Route::post('/interposicion', 'InterposicionController@store')->name('store_interposicion')->middleware('roles:admin');
Route::get('/interposicion/{interposicion}/show', 'InterposicionController@show')->name('show_interposicion')->middleware('roles:admin');
Route::get('/interposicion/{interposicion}/edit', 'InterposicionController@edit')->name('edit_interposicion')->middleware('roles:admin');
Route::put('/interposicion/{interposicion}', 'InterposicionController@update')->name('update_interposicion')->middleware('roles:admin');
Route::get('/interposicion/{interposicion}', 'InterposicionController@destroy')->name('destroy_interposicion')->middleware('roles:admin');

//FIN INTERPOSICIONES


//JUICIOS

Route::get('/juicios/admin', 'JuicioController@index')->name('admin_juicio')->middleware('roles:admin');
Route::get('/juicios/create', 'JuicioController@create')->name('create_juicio')->middleware('roles:admin');
Route::post('/juicios', 'JuicioController@store')->name('store_juicio')->middleware('roles:admin');
Route::get('/juicios/{juicio}/edit', 'JuicioController@edit')->name('edit_juicio')->middleware('roles:admin');
Route::put('/juicios/{juicio}', 'JuicioController@update')->name('update_juicio')->middleware('roles:admin');
Route::get('/juicios/{juicio}', 'JuicioController@destroy')->name('destroy_juicio')->middleware('roles:admin');

//FIN JUICIOS


//MAGISTRADOS

Route::get('/magistrado/admin', 'MagistradosController@index')->name('admin_magistrado')->middleware('roles:admin');
Route::get('/magistrado/reporte', 'MagistradosController@reporte')->name('reporte_magistrado')->middleware('roles:admin,magistrado,sga');
Route::get('/magistrado/create', 'MagistradosController@create')->name('create_magistrado')->middleware('roles:admin');
Route::post('/magistrado', 'MagistradosController@store')->name('store_magistrado')->middleware('roles:admin');
Route::get('/magistrado/{magistrado}/edit', 'MagistradosController@edit')->name('edit_magistrado')->middleware('roles:admin');
Route::put('/magistrado/{magistrado}', 'MagistradosController@update')->name('update_magistrado')->middleware('roles:admin');
Route::get('/magistrado/{magistrado}/show', 'MagistradosController@show')->name('show_magistrado')->middleware('roles:admin');
Route::get('/magistrado/{magistrado}', 'MagistradosController@destroy')->name('destroy_magistrado')->middleware('roles:admin');

//FIN MAGISTRADOS

//NOTIFICACIONES

Route::get('/notificacion/reporte', 'NotificacionesController@reporte')->name('reporte_notificacion')->middleware('roles:admin,actuario,sga');
Route::get('/notiifcacion/admin', 'NotificacionesController@index')->name('admin_notificacion')->middleware('roles:admin,actuario,sga');
//Route::get('/notificacion/admin', 'NotificacionesController@index')->name('admin_notificacion')->middleware('roles:admin');
Route::get('/notificacion/create', 'NotificacionesController@create')->name('create_notificacion')->middleware('roles:admin');
Route::post('/notificacion', 'NotificacionesController@store')->name('store_notificacion')->middleware('roles:admin');
Route::get('/notificacion/{notificacion}/show', 'NotificacionesController@show')->name('show_notificaciones')->middleware('roles:admin,sga,actuario');
Route::get('/notificaciones/{notificacion}/autorizar', 'NotificacionesController@autoriza')->name('autorizar_notificacion')->middleware('roles:admin,sga');
Route::put('/notificaciones/autorizar/{notificacion}', 'NotificacionesController@modify_autoriza')->name('modify_autorizacion')->middleware('roles:admin');
Route::get('/notificacion/create/{aa}', 'NotificacionesController@create_na')->name('create_notificacion_actuacion')->middleware('roles:admin');
Route::post('/notificacion/{aa}', 'NotificacionesController@store')->name('store_notificacion_actuacion')->middleware('roles:admin');
Route::get('/notificacion/self/{aa}', 'NotificacionesController@store_notificacion')->name('store_notificacion_actuacion_automatico')->middleware('roles:admin,actuario');
Route::get('/notificaciones/{notificacion}', 'NotificacionesController@destroy')->name('destroy_notificacion')->middleware('roles:admin');


//FIN NOTIFICACIONES


// PDF

Route::get('/pdf/{usuarios}', 'PDFController@PDF')->name('descargarPDF');
Route::get('/pdf/actuaciones/{aa}', 'PDFController@actuacionesPDF')->name('descargar_actuacionesPDF');
Route::get('/pdf/cedula/{certificacion}', 'PDFController@cedulaPDF')->name('descargar_cedulaPDF');
Route::get('/QR_generate', 'PDFController@QR_generate')->name('generar_QR');


//FIN PDF


// PERFIL FIRMAS

Route::resource('perfilfirma','PerfilFirmaController')->middleware('roles:admin');
Route::get('/perfilfirmas/admin/', 'PerfilFirmaController@index')->name('admin_perfilfirmas')->middleware('roles:admin');
Route::get('/perfilfirma/{perfilfirma}/destroy', 'PerfilFirmaController@destroy')->name('destroy_perfilfirma')->middleware('roles:admin');
//Route::get('/expedientes/admin/{usuario}', 'AsignaExpedientesController@index')->name('admin_expedientes_user');

// FIN PERFIL_FIRMAS

//PONENCIAS


Route::get('/ponencia/admin', 'PonenciasController@index')->name('admin_ponencia')->middleware('roles:admin');
Route::get('/ponencia/create', 'PonenciasController@create')->name('create_ponencia')->middleware('roles:admin');
Route::post('/ponencia', 'PonenciasController@store')->name('store_ponencia')->middleware('roles:admin');
Route::get('/ponencia/{ponencia}/show', 'PonenciasController@show')->name('show_ponencia')->middleware('roles:admin');
Route::get('/ponencia/{ponencia}/edit', 'PonenciasController@edit')->name('edit_ponencia')->middleware('roles:admin');
Route::put('/ponencia/{ponencia}', 'PonenciasController@update')->name('update_ponencia')->middleware('roles:admin');
Route::get('/ponencia/{ponencia}', 'PonenciasController@destroy')->name('destroy_ponencia')->middleware('roles:admin');

//FIN PONENCIAS

//PUESTOS

Route::get('/puestos/admin', 'PuestosController@index')->name('admin_puesto')->middleware('roles:admin');
Route::get('/puestos/create', 'PuestosController@create')->name('create_puesto')->middleware('roles:admin');
Route::post('/puestos', 'PuestosController@store')->name('store_puesto')->middleware('roles:admin');
Route::get('/puestos/{puesto}/show', 'PuestosController@show')->name('show_puesto')->middleware('roles:admin');
Route::get('/puestos/{puesto}/edit', 'PuestosController@edit')->name('edit_puesto')->middleware('roles:admin');
Route::put('/puestos/{puesto}', 'PuestosController@update')->name('update_puesto')->middleware('roles:admin');
Route::get('/puestos/{puesto}', 'PuestosController@destroy')->name('destroy_puesto')->middleware('roles:admin');

//FIN PUESTOS

// ROLES

Route::get('/roles/admin', 'RolesController@index')->name('admin_rol')->middleware('roles:admin');
Route::get('roles/create', 'RolesController@create')->name('create_rol')->middleware('roles:admin');
Route::post('/roles', 'RolesController@store')->name('store_rol')->middleware('roles:admin');
Route::get('/roles/{rol}/show', 'RolController@show')->name('show_rol')->middleware('roles:admin');
Route::get('/roles/{roles}/activate', 'RolesController@activate')->name('activate_rol')->middleware('roles:admin');
Route::get('/roles/{roles}/desactivate', 'RolesController@desactivate')->name('desactivate_rol')->middleware('roles:admin');
Route::get('/roles/{roles}/edit', 'RolesController@edit')->name('edit_rol')->middleware('roles:admin');
Route::put('/roles/{roles}', 'RolesController@update')->name('update_rol')->middleware('roles:admin');
Route::get('/roles/{roles}', 'RolesController@destroy')->name('destroy_rol')->middleware('roles:admin');

//FIN ROLES

// TAREAS

Route::get('/tareas/admin', 'TareasController@index')->name('admin_tarea')->middleware('roles:admin');
Route::get('tareas/create', 'TareasController@create')->name('create_tarea')->middleware('roles:admin');
Route::post('/tareas', 'TareasController@store')->name('store_tarea')->middleware('roles:admin');
Route::get('/tareas/{tarea}/show', 'TareasController@show')->name('show_tarea')->middleware('roles:admin');
Route::get('/tareas/{tarea}/edit', 'TareasController@edit')->name('edit_tarea')->middleware('roles:admin');
Route::put('/tareas/{tarea}/', 'TareasController@update')->name('update_tarea')->middleware('roles:admin');
Route::get('/tareas/{tarea}', 'TareasController@destroy')->name('destroy_tarea')->middleware('roles:admin');


//FIN TAREAS


// USUARIOS


Route::get('/usuarios/admin', 'TrijezUserController@index')->name('admin_user')->middleware('roles:admin,op');
Route::get('/usuarios/firmantes', 'TrijezUserController@firmantes')->name('usuarios_firmantes')->middleware('roles:admin,op');
Route::get('/usuarios/create/', 'TrijezUserController@create')->name('create_usuario')->middleware('roles:admin,op');
Route::get('/usuarios/create/externo/', 'TrijezUserController@create_externo')->name('create_usuario_externo')->middleware('roles:admin,op');
Route::get('/usuarios/create/externo/{expediente}', 'TrijezUserController@create_externo_expediente')->name('create_usuario_externo_expediente')->middleware('roles:admin,op');
Route::post('/usuarios', 'TrijezUserController@store')->name('store_usuario')->middleware('roles:admin,op');
Route::post('/usuarios/externo', 'TrijezUserController@store_externo')->name('store_usuario_externo')->middleware('roles:admin,op');
Route::post('/usuarios/externo/{user}', 'TrijezUserController@update_externo')->name('update_usuario_externo')->middleware('roles:admin,op');
Route::post('/usuarios/externo/{expediente}', 'TrijezUserController@store_externo_expediente')->name('store_usuario_externo_expediente')->middleware('roles:admin,op');
Route::post('/usuarios/tint/{expediente}', 'TrijezUserController@store_terceros')->name('store_terceros')->middleware('roles:admin,op');
Route::get('/usuarios/{user}/show', 'TrijezUserController@show')->name('show_usuario')->middleware('roles:admin,op');
Route::get('/usuarios/{usuario}/activate', 'TrijezUserController@status')->name('status_usuario')->middleware('roles:admin,op');
Route::put('/usuarios/activate/{usuario}', 'TrijezUserController@modify_status')->name('modify_status')->middleware('roles:admin,op');
Route::get('/usuarios/{user}/edit', 'TrijezUserController@edit')->name('edit_usuario')->middleware('roles:admin,op');
Route::put('/usuarios/{user}', 'TrijezUserController@update')->name('update_usuario')->middleware('roles:admin,op');
Route::get('/usuarios/{user}', 'TrijezUserController@destroy')->name('destroy_usuario')->middleware('roles:admin');


//FIN USUARIOS

/*Route::get('/expediente/{expediente}/edit', 'ExpedienteController@edit')->name('edit_expediente');
Route::put('/expediente/{expediente}', 'ExpedienteController@update')->name('update_expediente');*/
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users','UsersController');
Route::view('productos/borrar/{id}','ProductoController@borrar');
//Route::get('/public/uploads/{{src}}', 'AsignaActuacionesController@download')->name('download_addact');
//Route::get('/storage/admin', 'StorageController@index')->name('storage_admin');;
//Route::post('storage/create', 'StorageController@save');
/*Route::get('storage/{archivo}', function ($archivo) {
    $public_path = public_path();
    $url = $public_path.'/storage/'.$archivo;
    //verificamos si el archivo existe y lo retornamos
    if (Storage::exists($archivo))
    {
      return response()->download($url);
    }
    //si no se encuentra lanzamos un error 404.
    abort(404);
});*/
//Route::get('/perfilfirma/{perfilfirma}', 'PerfilFirmaController@destroy')->name('destroy_sign');
