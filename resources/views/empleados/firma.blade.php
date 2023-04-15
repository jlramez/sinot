@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-pen-alt"> Asignar permisos para firma de documentos a Empleados del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
@stop

@section('content')

            <div class="card">
                <div class="card-header">{{ __('Asignar permiso para firma de documentos') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                         @endif
                    <form method="POST" action="{{url('empleados/firma/'.$empleado->id) }}">
                        @method('put')
                        @csrf

                        <div class="form-group ">
                            <label for="name">{{ __('Nombre del Empleado') }}</label>
                            <div class="">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                 name="name" value="{{ old('name', $empleado->nombre.' '.$empleado->ap.' '.$empleado->am) }}" required autocomplete="name" autofocus disabled >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group " >
                            <div class="col-md-6 offset-md-4" >
                                <button type="submit" class="btn btn-dark"><i class="fas fa-pen-alt"></i>
                                    {{ __('Activar/Desactivar permiso para firma') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer" align="right">     
                      <a href="{{ url( 'empleados/admin')}}"" class="btn btn-dark" ><i class="fas fa-check-circle"></i>Regresar</a>        
                    </div>
            </div>
   
@endsection