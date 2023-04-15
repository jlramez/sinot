@extends('adminlte::page')

@section('title', 'Buzones')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-mail-bulk"> Buzones del Sistema de  Notificación Electrónica del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
@stop

@section('content')
<div class="card">
<div class="card-header">
            {{ Form::open(['route' => 'admin_buzon', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}   
  
            {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Escriba el correo electrónico']) }}
      
            <div class="form-group">
                  <button type="submit" class="btn btn-default">
                      <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
                  </button>     
            </div>                           
          {{ Form::close() }}
            <div  align="right">
            @canany(['admin','magistrado']) <a href="{{ url('buzon/create' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i>Agregar Buzón</a>@endcanany
            </div>
</div>
               <div class="card-body"> 
               @if (session('status'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                 <table class="table table-stripedtable-sm">
                    <thead thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th >Usuario</th>
                            <th >Descripcion</th>                            
                            <!--<th >Mensajes nuevos  </th>                                                 
                            <th>Mensajes Leídos</th>-->
                             <th>Herramientas</th>
                           
                            
                          </tr>
                     </thead>
                     <tbody>
                          @foreach($buzones as  $buzon)
                              <tr>
                                  <td>{{$buzon->id }}</td>  
                                  <td>{{$buzon->users->name }}</td>  
                                  <td>{{$buzon->descripcion }}</td>
                                 
                                  <!--<td align="center"><span class="badge badge-danger">5</span></td>
                                  <td>10</td>-->
                                                                                                  
                                
                                  <td >
                                  <a href="{{ url( 'asigna_notificaciones/'.$buzon->id.'/show')}}" title="Ver mensajes de la bandeja"  ><i class="fas fa-eye"style="color:black" ></i></a>
                                  <a href="{{route('edit_buzon', $buzon->id) }}" title="Editar información del buzón" ><i class="fas fa-pencil-alt" style="color:black"></i></a>
                                  @canany(['admin','magistrado'])<a href="{{ route('destroy_buzon',$buzon->id) }}" title="Eliminar Buzón" onclick="return confirm('¿Realmente desea elimiar el regisro?')">
                                  <i class="fas fa-trash-alt" style="color:black"></i></a>@endcanany</td>
                              </tr>
                          @endforeach
                    </tbody>
                 </table>
                </div>
                  <div class="card-footer" align="left">
                        {{ $buzones->links() }}
                  </div>                  
        </div>
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop