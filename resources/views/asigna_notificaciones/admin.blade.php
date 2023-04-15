@extends('adminlte::page')

@section('title', 'Bandeja de entrada')

@section('content_header')
   
@stop

@section('content')
        <div class="card">
            <div class="card-header" >
                    <h5><span><i class="fas fa-check-circle"> Bandeja de entrada</i> <i class="far fa-star" style="color:#766f61"></i></span></h5>
               <div class="float-right">
                          {{ Form::open(['route' => ['show_addnot',$id_b], 'method' => 'GET', 'class' => 'form-inline pull-right']) }}                          
                          {{ Form::text('searchan', null, ['class' => 'form-control', 'placeholder' => 'Escriba la fecha']) }}                       
                              <div class="form-group">
                                  <button type="submit" class="btn btn-default">
                                      <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
                                  </button>
                              </div>                           
                           {{ Form::close() }}
               </div>     
             </div>  

      
              <div class="card-body">
               
                        <style>
                                .estado1 {background-color : #9b9b9b !important; }
                                .estado2 {background-color : #367068
          !important; }
                        </style>
                 <table class="table  table-stripped table-sm">
                    <thead thead class="table-dark">
                        <tr>
                            <!--<th>ID</th>
                            <th >Expediente</th>
                            <th >Actuación</th> -->                           
                            <!--<th >Descripción  </th>
                            <th >Archivo Adjunto  </th> 
                            <th >Mensajes Nuevos  </th>
                            <th >Total de mensajes  </th>                                              
                            <th>Herramientas</th> -->                        
                            
                          </tr>
                     </thead>
                     <tbody>

                          @foreach($asigna_notificaciones as  $an)
                            @if($an->buzones->users->id===auth()->id()) 
                                          @if($an->leida==1)                       

                                            <tr class="estado1" textcolor="cccccc">
                                        
                                          @elseif($an->leida==0)
                                          <tr class="estado2">
                                          @endif

                                          <td><font color=#FFFFFF>Tribunal de Justicia Electoral del Estado de Zacatecas<!--, -- {{$an->notificaciones->asigna_actuaciones->expedientes->ponencias->magistrados->nombre}}
                                          {{$an->notificaciones->asigna_actuaciones->expedientes->ponencias->magistrados->primerapellido}}
                                          {{$an->notificaciones->asigna_actuaciones->expedientes->ponencias->magistrados->segundoapellido}}--></font></td>
                                          <!--<td>{{$an->id }}</td> 
                                          <td>{{$an->notificaciones->asigna_actuaciones->folio}}</td>  -->
                                          <td ><font color=#FFFFFF>{{$an->notificaciones->asigna_actuaciones->actuacions->Nombre}}-{{$an->notificaciones->asigna_actuaciones->folio}}</font></td> 
                                          <td><font color=#FFFFFF>{{ date('Y-m-d H:i:s a',strtotime($an->created_at))}}</font></td>
                                          <!--<td>{{$an->notificaciones->asigna_actuaciones->resumen_actuacion}}</td>-->
                                          <!--<td><a href="{{url('/storage/'.
                                          $an->notificaciones->asigna_actuaciones->nombre_dcto_app)}}">
                                          {{$an->notificaciones->asigna_actuaciones->nombre_dcto}}</a> </td>-->
                                        
                                          <!--<td align="center"><span class="badge badge-danger">5</span></td>
                                          <td>10</td>-->
                                                                                                          
                                        
                                          <td align="justify-content-center"><a href="{{ url( '/asigna_notificaciones/'.$an->id.'/read')}}" title="Leer mensaje" ><i class="fas fa-eye" style="color:white"></i></a>
                                        <a href="{{route('edit_buzon', $an->buzones_id) }}" ><i class="fas fa-pencil-alt" style="color:white"  title="Editar buzón"></i></a>
                                        <a href="{{ route('destroy_addnot',$an->id) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')"  title="Eliminar mensaje"
                                            ><i class="fas fa-trash-alt" style="color:white"></i></a></td>
                                      </tr>
                            @endif
                          @endforeach
                    </tbody>
                 </table>
                </div>
     
                  <div class="card-footer" align="rigth">
                  <span><i class="fas fa-square" style="color:#9b9b9b"></i> Leído(s)</span>
                  <span><i class="fas fa-square" style="color:#367068"></i> NO Leído(s)</span>
                  </div>                  
        </div>
    
@endsection
