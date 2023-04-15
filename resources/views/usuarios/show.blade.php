@extends('adminlte::page')

@section('title', 'mostrar usuarios')

@section('content_header')
   
@stop

@section('content')

                <h3>{{ $usuario->name}}</h3>
                <div class="card"> 
                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                    <div class="card-body" >
                         <p>Nombre: {{ $usuario->name}}</p>
                         <p>Correo electrónico: {{ $usuario->email}}</p>
                         <p>Rol de Usuario: 
                          @foreach($usuario->roles as $roles)
                            {{$roles->descripcion}} 
                          @endforeach
                         </p>
                         <p>ID Empleado: {{$usuario->empleados_id}} </p>
                       
                          
                        
                    </div>                    
                    <div class="card-footer" align="right">    
                      <a href="{{ url('/usuarios/admin') }}" class="btn btn-dark" ><i class="fas fa-check-circle"></i>Regresar</a>        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection