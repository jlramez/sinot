<style>
      textarea:focus, input:focus, input[type]:focus 
      {
            border-color: rgb(54, 112, 104);
            box-shadow: 0 1px 1px rgba(54, 112, 104, 0.075)inset, 0 0 8px rgba(54, 112, 104,0.6);
            outline: 0 none;

       }
    
       option:hover {
         background:green
        }
       

  </style>
@extends('adminlte::page')

@section('title', 'Crear puestos')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-vote-yea">Crear Puestos del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
@stop
@section('content')

            <div class="card">
                <div class="card-header">{{ __('Nuevo ') }}</div>
                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('store_puesto') }}">
                        @csrf

                        <div class="form-group ">
                            <label for="descripción" >{{ __('Nombre del puesto') }}</label>

                            <div class="">
                                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" required autocomplete="descripcion" autofocus>

                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="nomenclatura" >{{ __('Nomenclatura') }}</label>

                            <div class="">
                                <input id="nomenclatura" type="nomenclatura" class="form-control @error('nomenclatura') is-invalid @enderror" name="nomenclatura" value="{{ old('nomenclatura') }}" required autocomplete="nomenclatura">

                                @error('Nomenclatura')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="Área / Procedencia" >{{ __('Area / Procedencia') }}</label>                                  
                            <div class=""> 
                                <select name="areas_id" id="areas_id" class="form-control">
                                    @foreach ($rsa as $area) 
                                      <option value="{{ $area->id }}">{{ $area->descripcion }}</option>
                                     @endforeach
                                </select> 
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
            </div>
            <div class="card-footer" align="right"> 
                      <a href="{{ url( 'puestos/admin')}}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a> 
            </div>
        </div>
  
@endsection


