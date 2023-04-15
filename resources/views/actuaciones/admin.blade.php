@extends('adminlte::page')

@section('title', 'Actuaciones')

@section('content_header')
    <font color="#367068"><h1><i class="fas fa-address-book">Actuaciones existentes para  expedientes dentro del Notrijez</i></h1></font>
@stop

@section('content')
<div class="card">
<div class="card-header">
    
                        
    {{ Form::open(['route' => 'admin_actuacion', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
      
    {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Escriba la actuación']) }}
    
        
        <div class="form-group">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
            </button>
        </div>                           
    {{ Form::close() }}

<!--<input class="form-control" placeholder="Escriba el nombre y/o apellidos  de la empleada o empleado" name="nombre">-->

</div>
    <div align="right">
    @canany(['admin','magistrado'])<a href="{{ route ('create_actuacion' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i>Agregar Actuación</a>@endcanany
        </div>
    <div class=card-body> 
                 <table class="table table-striped  table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>                                               
                            @canany(['admin','magistrado'])<th>Herramientas</th>@endcanany
                           
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr>
                    </tbody>
                        @foreach($actuaciones as $actuacion)
                            <tr>
                                <td >{{$actuacion->id }}</td>
                                <td >{{$actuacion->Nombre }}</td>
                                <td ><!--<a href="{{ url( 'actuacion/'.$actuacion->id.'/show')}}" ><i class="fas fa-eye"style="color:black" ></i></a>-->
                               @canany(['admin','magistrado'])
                                      <a href="{{ url('/actuacion/'.$actuacion->id.'/edit') }}" title="Editar actuación"><i class="fas fa-pencil-alt" style="color:black"></i></a>
                                <a href="{{ route('destroy_actuacion',$actuacion->id) }}"   onclick="return confirm('¿Realmente desea elimiar el regisro?')"  title="Eliminar actuación"><i class="fas fa-trash-alt" style="color:black"></i></a></td>
                                @endcanany
                            </tr>
                        @endforeach
                    </tbody>
                 </table>
               </div>
               <div class="card-footer" align="right">
                    {{ $actuaciones->links() }}
               </div>         
            </div>

           
        </div>
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    $('.formulario-eliminar').submit(function(e){
        e.preventDefault();
          

    });
  
</script>
@stop


