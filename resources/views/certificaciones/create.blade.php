<!-- Jquery -->
<script src="/js/jquery-1.11.3.min.js"></script>
    <!-- Scripts -->
    
    
    <!-- Stylesheet -->
	<link href="/css/bootstrap-tagsinput.css" rel="stylesheet" type="text/css">
	<!-- JavaScript -->
	<script src="/js/bootstrap-tagsinput.js"></script>
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
<font color="#367068"><h1><i class="fas fa-check-double">Agregar documento(s) para certificación en las actuaciones de los expedientes  del TRIJEZ</i></h1></font
@stop

@section('content')
            <div class="card">
                <div class="card-header">{{ __('Asigna documentos a actuación: ') }}{{$aa->actuacions->Nombre}}</div>
                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('store_cert', $aa->id) }}" enctype="multipart/form-data">
                        @csrf

                        

                        <div class="form-group ">
                            <label for="folio" >{{ __('Expediente:') }}</label>

                            <div class="">
                                <input id="folio" type="text" class="form-control @error('folio') is-invalid @enderror" name="folio" value="{{ old('folio', $aa->folio) }}" required autocomplete="folio" disabled>

                                @error('folio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group ">
                            <label for="folio" >{{ __('Actuación:') }}</label>

                            <div class="">
                                <input id="actuacion" type="text" class="form-control @error('actuacion') is-invalid @enderror" name="actuacion" value="{{ old('folio', $aa->actuacions->Nombre) }}" required autocomplete="folio" disabled>

                                @error('actuacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="magistrado" >{{ __('Magistrado Instructor:') }}</label>

                            <div class="">
                            <input id="magistrado" type="text" class="form-control @error('magistrado') is-invalid @enderror" name="magistrado" value="{{ old('magistrado', $aa->expedientes->ponencias->magistrados->nombre.' '. $aa->expedientes->ponencias->magistrados->primerapellido.' '. $aa->expedientes->ponencias->magistrados->segundoapellido) }}" required autocomplete="magistrado" disabled>

                                @error('magistrado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="folio" >{{ __('# de Fojas del Documento:') }}</label>

                            <div class="">
                                <input id="fojas" type="text" class="form-control @error('fojas') is-invalid @enderror" name="fojas" value="{{ old('fojas') }}" required autocomplete="fojas" >

                                @error('fojas')
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

                        <!--AUTORIZADA-->

                        
                        <div class="form-group ">
                            <label for="documento" >{{ __('Agregar archivo(s) adjunto(s) para certificar:') }}</label>
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
                      <a href="{{ url( 'asigna_actuaciones/'.$aa->expedientes_id.'/show')}}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a> 
                          
                    </div>
            </div>   
@endsection