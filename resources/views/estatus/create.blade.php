@extends('adminlte::page')

@section('title', 'Estátus')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-check-square"> Crear estátus para los espedientes del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
@stop
@section('content')

        <div class="card">
                <div class="card-header">{{ __('Nuevo  ') }}</div>
                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('store_estatus') }}">
                        @csrf

                        <div class="form-group ">
                            <label for="descripción" >{{ __('Nombre del estatus') }}</label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" required autocomplete="descripcion" autofocus>

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
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            
            <div class="card-footer" align="right"> 
                      <a href="{{ route( 'admin_expediente')}}"" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a> 
            </div>
        </div>
@endsection
