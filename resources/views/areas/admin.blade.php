<link href="{{ asset('css/app.css') }}" rel="stylesheet">


@extends('adminlte::page')

@section('title', 'Áreas')

@section('content_header')
    <h1><i class="fas fa-location-arrow"> Áreas X del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1>
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

            <div  align="right">
              <a href="{{ route ('create_area' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i>Agregar Área</a>
            </div>
</div>
               <div class=card-body> 
                 <table class="table table-striped  table-sm">
                    <thead thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th >Nombre</th>                    
                            <th>Nom</th>
                             <th>Herramientas</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($areas as $area)
                            <tr>
                                <td>{{$area->id }}</td>
                                <td >{{$area->descripcion }}</td>
                                <td>{{$area->nomenclatura}}</td>
                            @canany(['admin'])
                                <td ><a href="{{ url( 'areas/'.$area->id.'/show')}}" title="Ver área" ><i class="fas fa-eye" style="color:black"></i></a>
                                <a href="{{ url('/areas/'.$area->id.'/edit') }}" ><i class="fas fa-pencil-alt" style="color:black" title="Editar área"></i></a>
                                <a href="{{ route('destroy_area',$area->id) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')" title="Borrar área" ><i class="fas fa-trash-alt" style="color:black"></i></a></td>
                            @endcanany
                            </tr>
                        @endforeach
                    </tbody>
                 </table>
               </div>
               <div class="card-footer" align="right">
                    {{ $areas->links() }}
               </div>         
            </div>

           
        </div>
    </div>
</div>
@endsection

