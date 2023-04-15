<link href="{{ asset('css/app.css') }}" rel="stylesheet">


@extends('adminlte::page')

@section('title', 'Áreas')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-sign-in-alt"> Bitácora de acceso al Sistema de Notificaciones</i></h1></font>
@stop
@section('content')
<div class="card">
<div class="card-header">
    
                        
    {{ Form::open(['route' => 'admin_area', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
      
    {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Escriba el área']) }}
    
        
        <div class="form-group">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
            </button>
        </div>                           
    {{ Form::close() }}

<!--<input class="form-control" placeholder="Escriba el nombre y/o apellidos  de la empleada o empleado" name="nombre">-->

          
</div>
               <div class=card-body> 
                 <table class="table table-striped  table-sm">
                    <thead thead class="table-dark">
                        <tr align="center">
                            <th>ID</th>
                            <th >Nombre</th> 
                            <th >Usuario</th>                    
                            <th>Dirección IP</th>
                             <th>Fecha</th>
                             <th colspan="3" > Herramientas</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accesos as $acceso)
                            <tr>
                                <td align="center">{{$acceso->id }}</td>
                                <td align="center">{{$acceso->user->name }}</td>
                                <td align="center">{{$acceso->user->email }}</td>
                                <td align="center">{{$acceso->ip }}</td>
                                <td align="center">{{$acceso->last_login}}</td>
                                <td align="center">{{$acceso->nomenclatura}}</td>
                            @canany(['admin'])
                            <td align="center" ><a href="{{ url( 'areas/'.$acceso->id.'/show')}}" title="Desactivar usuario" class="btn btn-outline-success">Activar</a>
                            <a href="{{ url( 'areas/'.$acceso->id.'/show')}}" title="Desactivar usuario" class="btn btn-outline-danger">Desactivar</a></td>
                            @endcanany
                            </tr>
                        @endforeach
                    </tbody>
                 </table>
               </div>
               <div class="card-footer" align="right">
                    {{ $accesos->links() }}
               </div>         
            </div>

           
        </div>
    </div>
</div>
@endsection

