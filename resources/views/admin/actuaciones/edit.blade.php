@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Actuación') }}</div>
                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                <div class="card-body">
                    <form method="POST" action="{{url('actuacion/'.$actuacion->id) }}">
                    @method('put')
                        @csrf

                        <div class="form-group ">
                            <label for="Nombre">{{ __('Nombre de la tarea') }}</label>
                            <div class="col-md-6">
                                <input id="Nombre" type="text" class="form-control @error('Nombre') is-invalid @enderror"
                                 name="Nombre" value="{{ old('Nombre', $actuacion->Nombre) }}" required autocomplete="Nombre" autofocus>

                                @error('Nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i>
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer" align="right"> 
                      <!--<a href="{{ url( 'expedientes/admin')}}"" class="btn btn-danger" ><i class="fas fa-file-pdf"></i>Adjuntar </a>   
                      <a href="{{ url( 'expedientes/admin')}}"" class="btn btn-primary" ><i class="fas fa-file-word"></i>Adjuntar </a> --> 
                      <a href="{{ url( 'actuacion/admin')}}"" class="btn btn-success" ><i class="fas fa-check-circle"></i>Aceptar</a>        
            </div>
        </div>
    </div>
</div>
@endsection