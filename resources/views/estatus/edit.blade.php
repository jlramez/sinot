@extends('adminlte::page')

@section('title', 'Estátus')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-check-square">Editar estátus  de  estado que guardan los  expedientes dentro del Notrijez</i></h1>>/font>
@stop

@section('content')
        <div class="card">
                <div class="card-header">{{ __('Editar Estátus') }}</div>
                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                <div class="card-body">
                    <form method="POST" action="{{url('estatus/'.$estatus->id) }}">
                    @method('put')
                        @csrf

                        <div class="form-group ">
                            <label for="descripcion">{{ __('Nombre del Estátus') }}</label>
                            <div class="">
                                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror"
                                 name="descripcion" value="{{ old('descripcion', $estatus->descripcion) }}" required autocomplete="descripcion" autofocus>

                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark"><i class="fas fa-check-circle"></i>
                                    {{ __('Guardar cambios') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer" align="right"> 
                      <a href="{{ url( 'estatus/admin')}}"" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a> 
            </div>
       </div>
    
@endsection
