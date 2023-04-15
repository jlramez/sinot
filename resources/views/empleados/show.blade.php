@extends('adminlte::page')

@section('title', 'Detalle de Empleados')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-user"> Detalle de Empleados(as) del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1>>/font>
@stop

@section('content')

                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                   
                <div class="card"> 
                <div class="card-header">
                   {{ $empleado->ap}} {{ $empleado->am}}, {{ $empleado->nombre}}
                   </div>
                    <div class="card-body" >
                         <p>Nombre: {{ $empleado->nombre}}</p>
                         <p>Primer apellido: {{ $empleado->ap}}</p>
                         <p>Segundo apellido: {{$empleado->am}} </p>
                         <p>Magistrado(Sí/No): {{$empleado->magistrado}} </p>
                         <p>CURP: {{$empleado->curp}} </p>
                         <p>RFC: {{$empleado->rfc}} </p>
                         <p>Correo electrónico: {{$empleado->email}} </p>
                          
                        
                    </div>                    
                    <div class="card-footer" align="right">    
                      <a href="{{ url('/empleados/admin') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i>Regresar</a>        
                    </div>
                </div>
            

@endsection