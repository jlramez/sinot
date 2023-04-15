@extends('adminlte::page')

@section('title', 'Expedientes')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-folder"> Expedientes del Sistema de  Notificación Electrónica del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
@stop

@section('content')
<div class="card">
            
    <div class="card-header">
    
                        
    {{ Form::open(['route' => 'admin_expediente', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}   
  
    {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Escriba el folio o actor']) }}
    
        
        <div class="form-group">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
            </button>
        </div>                           
    {{ Form::close() }}

<!--<input class="form-control" placeholder="Escriba el nombre y/o apellidos  de la empleada o empleado" name="nombre">-->
            <div align="right">
            @canany(['admin','op'])
                <a href="{{ url('expediente/create' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i> Agregar Expediente</a>
            @endcanany(['admin','op'])
            </div>
            <div class="card-body">
            @if (session('status'))
                    @if (session('type'))
                            <div class="{{session('type')}}" role="alert">
                                {{ session('status')}}
                            </div>

                    @endif
                @endif
                <table class="table table-striped table-sm">
                    <thead class="table-dark" >
                        <tr>
                            <th>ID</th>
                            <th >Folio</th>
                            <th >Magistrado Instructor</th>
                                                                           
                            <th>Actor / Denunciante</th>
                            <th>Correo electrónico</th>
                          
                            <th>Fecha</th>                          
                            <th>Herramientas</th>
                           
                           
                          </tr>
                     </thead>
                     <tbody>
                          @foreach($expedientes as  $expediente)
                              <tr>
                                  <td>{{$expediente->id }}</td>
                                  @if($expediente->nuevo==1)
                                
                                  <td>{{$expediente->folio }}<span class="badge badge-info" >sin-usuario</span></td>
                                  @endif
                                  @if($expediente->nuevo==0)
                                  
                                  <td>{{$expediente->folio }}</td>
                                  @endif
                                  <td>{{$expediente->ponencias->magistrados->nombre }} {{$expediente->ponencias->magistrados->primerapellido }} {{$expediente->ponencias->magistrados->segundoapellido }}</td>
                                  
                                 <!-- <td>{{$expediente->interposicion_id}}</td>-->
                                 @if($expediente->nuevo==0)
                                  <td>{{$expediente->actor}}   <a href="{{route('create_usuario_externo_expediente', $expediente->id )}}" title="Agregar  terceros interesasdos" ><i class="fas fa-users" style="color: black;" ></i></a></td>
                                 @endif 
                                 @if($expediente->nuevo==1)
                                  <td>{{$expediente->actor}}   <a href="{{route('create_usuario_externo_expediente', $expediente->id ) }}" title="Agregar  usuario" ><i class="fas fa-user" style="color: black;" ></i></a></td>
                                 @endif
                                  <td >{{$expediente->email_actor}}</td> 
                                 
                                 <!-- <td>{{$expediente->accion}}</td>-->
                                  <!--<td>{{$expediente->terceros_interesados}}</td>
                                  <td>{{$expediente->coadyuvantes }}</td>
                                  <td>{{$expediente->sexo}}</td>-->
                                  <td>{{$expediente->fecha}}</td>
                                 <!-- <td>{{$expediente->hora}}</td>
                                  <td>{{$expediente->reencauzamiento}}</td>
                                  <td>{{$expediente->historico}}</td>
                                  <td>{{$expediente->observaciones}}</td>-->
                                   
                                 <!-- <td>{{$expediente->users_id }}</td>
                                  <td>{{$expediente->ponencias_id}}</td>
                                  <td>{{$expediente->juicios_id}}</td>-->
                                                                        
                                
                                  <td width="10px">
                                                    
                                                        <a href="{{ url( 'expediente/'.$expediente->id.'/show')}}"  title="Detalle expediente"><i class="fas fa-eye" style="color:black"></i></a>
                                                   
                                                    @canany(['admin','seceyc','actuario'])
                                                        <a href="{{ url( 'asigna_actuaciones/'.$expediente->id.'/show')}} " title="Agregar actuación"  ><i class="fas fa-plus-circle" style="color:black"></i></a>
                                                    @endcanany
                                                    @canany(['admin','op'])
                                                        <a href="{{route('edit_expediente', $expediente->id) }}" title="Editar expediente" ><i class="fas fa-pencil-alt" style="color:black"></i></a>
                                                    @endcanany
                                                    @can('admin')
                                                        <a href="{{ route('destroy_expediente',$expediente->id) }}"
                                                        onclick="return confirm('¿Realmente desea elimiar el regisro?')" title="Eliminar expediente"><i class="fas fa-trash-alt" style="color:black"></i></a>
                                                    @endcan
                                  </td>
                              </tr>
                          @endforeach
                    </tbody>
                 </table>
            </div>
                  <div class="card-footer" align="left">
                        {{ $expedientes->links() }}
                  </div>                  
        
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
