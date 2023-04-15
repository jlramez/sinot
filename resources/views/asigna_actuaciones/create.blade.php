	 <!-- Jquery -->
     <script src="/js/jquery-1.11.3.min.js"></script>
    <!-- Scripts -->
    
    
    <!-- Stylesheet -->
	<link href="/css/bootstrap-tagsinput.css" rel="stylesheet" type="text/css">
	<!-- JavaScript -->
	<script src="/js/bootstrap-tagsinput.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
       




.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@extends('adminlte::page')

@section('title', 'Agregar actuaciones')

@section('content_header')
    <h1><i class="fas fa-folder-plus">Agregar actuaciones a los expedientes  del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1>
@stop

@section('content')
            <div class="card">
                <div class="card-header">{{ __('Asigna actuación a expediente: ') }}{{$expediente->folio}}</div>
                    <div class="card-body">
                    @if (session('status'))
                
                @if (session('type'))
                       <script>
                       Swal.fire(
                                   "{{session('status')}}",
                                   'Presione Ok, para continuar',
                                   "{{session('type')}}"
                                   )
                       </script>                   
                              <!-- <div class="{{session('type')}}" role="alert">
                                   {{ session('status')}}
                               </div>-->

                 @endif
            @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('store_addact', $expediente->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group ">
                            <label for="estatus" >{{ __('Actuación:') }}</label>

                            <div class="">
                                  <select name="actuacion_id" id="actuacion_id" class="form-control" required> 
                                  <option value="">--Seleccione una opción--</option> 
                                    @foreach ($rsact as $actuacion) 
                                      <option value="{{ $actuacion->id }}">{{ $actuacion->Nombre }}</option required>
                                     @endforeach
                                </select> 
                                @error('actuacion_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="folio" >{{ __('Expediente:') }}</label>

                            <div class="">
                                <input id="folio" type="text" class="form-control @error('folio') is-invalid @enderror" name="folio" value="{{ old('folio', $expediente->folio) }}" required autocomplete="folio" disabled>

                                @error('folio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="user_id" >{{ __('Usuario:') }}</label>

                            <div class="">
                                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name', auth()->user()->name) }}" required autocomplete="user_name" disabled>
                                <input id="user_id" type="hidden" value="{{ old('user_id', auth()->user()->id) }}" > 
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="res_act" >{{ __('Observaciones para certificación:') }}</label>

                            <div class="">
                                <textarea id="res_act" type="text" class="form-control @error('res_act') is-invalid @enderror" name="res_act" value="{{ old('res_act') }}" required autocomplete="res_act" required></textarea>

                                @error('res_act')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                     

                        <!--AUTORIZADA-->

                        <div class="form-group ">
                            <label for="res_act" >{{ __('¿Necesita certificación?') }}</label>

                            <div class="form-check form-switch">
                            <label class="switch">
                                    <input name="certificacion" id="certificacion" type="checkbox">
                                    <span class="slider"></span>
                            </label>
                            
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="documento" >{{ __('Agregar acuerdo(s) adjunto(s):') }}</label>
                                <input id="documento" type="file"  name="documento[]" multiple required>
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
                     <!-- <a href="{{ url( 'expedientes/admin')}}"" class="btn btn-danger" ><i class="fas fa-file-pdf"></i>Adjuntar </a>   
                      <a href="{{ url( 'expedientes/admin')}}"" class="btn btn-primary" ><i class="fas fa-file-word"></i>Adjuntar </a> --> 
                      <!--<a href="{{ url( '/pdf/')}}" class="btn btn-danger" target="_blank" ><i class="fas fa-file-pdf"></i>  Generar archivo PDF</a>   -->
                      <a href="{{ url( 'asigna_actuaciones/'.$expediente->id.'/show')}}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a> 
                          
                    </div>
            </div>   
@endsection