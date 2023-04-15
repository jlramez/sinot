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

@section('title', 'Actuaciones')

@section('content_header')
   
@stop

@section('content')

            <div class="card">
                <div class="card-header">{{ __('Autorizar Actuacion') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                         @endif
                    <form method="POST" action="{{url('asigna_actuaciones/'.$aa->id) }}">
                        @method('put')
                        @csrf

                        <div class="form-group ">
                            <label for="Nombre">{{ __('Nombre de la Actuación') }}</label>
                            <div class="">
                                <input id="Nombre" type="text" class="form-control @error('Nombre') is-invalid @enderror"
                                 name="Nombre" value="{{ old('Nombre', $nombre_act) }}" required autocomplete="Nombre" autofocus disabled>

                                @error('Nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group " >
                            <div class="col-md-6 offset-md-4" >
                                <button type="submit" class="btn btn-dark"><i class="fas fa-power-off"></i>
                                    {{ __('Autorizar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer" align="right">     
                      <a href="{{ url( 'asigna_actuaciones/'.$id_expediente.'/show')}}"" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
            </div>
@endsection
