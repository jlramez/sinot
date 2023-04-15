@extends('adminlte::page')

@section('title', 'Administración Usuarios')

@section('content_header')
    <h1>Listado de usuarios</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
                {{ Form::open(['url' => '/users', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}   
  
                {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Escriba el nombre']) }}
  
      
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
                        </button>
                    </div>                           
            {{ Form::close() }}

            <div  align="right">
                <a href="{{ url('users/create/' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i>Agregar Usuario</a>
                <a href="{{ url('usuarios/create/externo' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i>Agregar Usuario Externo</a>
            </div>
        </div>
        <div class="card-body">
        <table class="table data-table table-striped table-sm">
                    <thead thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th >Nombre</th>                    
                            <th>Email</th>

                            <th>Adscripción</th>
                            <th>Permisos</th>
                            <th>Herramientas</th>
                          
                           
                          </tr>
                     </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                                  <td>{{$user->id }}</td>
                                  <td >{{$user->name }}</td>
                                  <td>{{$user->email}}</td>
                                                                                                    
                                  <td><a href="{{ route( 'show_addrol', $user->id)}}" title="Mostrar roles" ><i class="fas fa-tasks" style="color:black"></i></a>
                                      <a href="{{ url( '/users/'.$user->id)}}" title="Detalle usuario"><i class="fas fa-eye" style="color:black"></i></a>
                                      <a href="{{ url( '/users/'.$user->id.'/edit')}}" title="Editar usuario"><i class="fas fa-edit" style="color:black"></i></a>
                                      <a href="#" data-toggle="modal" data-target="#deleteModal" data-userid="{{$user['id']}}"><i class="fas fa-trash-alt" style="color:black"></i></a></td>  
                                 

                    </tr>
                @endforeach
            </tbody>
        </table>

        </div>
            <!-- delete Modal-->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you shure you want to delete this?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body">Select "delete" If you realy want to delete this user.</div>
                <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form method="POST" action="">
                    @method('DELETE')
                    @csrf
                    {{-- <input type="hidden" id="user_id" name="user_id" value=""> --}}
                    <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Delete</a>
                </form>
                </div>
            </div>
            </div>
        </div>
        <div class="card-footer">

        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="/vendor/chart.js/Chart.min.js"></script>
<script src="/js/admin/demo/chart-area-demo.js"></script>

    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var user_id = button.data('userid') 
            
            var modal = $(this)
            // modal.find('.modal-footer #user_id').val(user_id)
            modal.find('form').attr('action','/users/' + user_id);
        })
</script>
@stop