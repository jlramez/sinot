 <!-- Scripts -->
 <script src="{{ asset('js/app.js') }}"></script> 
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
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

@section('title', 'Perfiles para firma  de usuario')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-pen-alt">Perfiles para firma de usuario del Sistema Notrijez</i></h1></font>
@stop
@blade
@section('content')

            <div class="card">
                <div class="card-header">{{ __('Nuevo Perfil de Firma') }}</div>
                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                <div class="card-body">
                    <form method="POST" action="{{ url('perfilfirma/') }}">
                        @csrf

                        <div class="form-group ">
                            <label for="descripción" >{{ __('Nombre Perfil de Firma') }}</label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" required autocomplete="descripcion" autofocus>

                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="slug" >{{ __('Slug del perfil de firma') }}</label>

                            <div class="col-md-6">
                                <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}" required autocomplete="slug" autofocus>

                                @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                      
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark"><i class="fas fa-check-circle"></i>
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <script>
                        $(document).ready(function(){
                            $('#descripcion').keyup(function(e){
                                var str = $('#descripcion').val();
                                str = str.replace(/\W+(?!$)/g, '-').toLowerCase();//rplace stapces with dash
                                $('#slug').val(str);
                                $('#slug').attr('placeholder', str);
                            });
                        });
        
    </script>
                </div>
            </div>
            <div class="card-footer" align="right"> 
                      <a href="{{ url( 'perfilfirmas/admin')}}"" class="btn btn-dark" ><i class="fas fa-check-circle"></i>Aceptar</a> 
            </div>
        </div>
  
@endsection
