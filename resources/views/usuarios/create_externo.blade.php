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

@section('title', 'Agregar Usuarios Externos')

@section('content_header')
 


            <div class="card">
                <div class="card-header">{{ __('Registrar Usuarios Externos') }}</div>

                <div class="card-body">
                @if (session('status'))
                    @if (session('type'))
                            <div class="{{session('type')}}" role="alert">
                                {{ session('status')}}
                            </div>

                    @endif
                @endif
                    <form method="POST" action="{{ route('store_usuario_externo') }}">
                        @csrf
                                                              
                                               
                            <div class="form-group ">
                                <label for="name" >{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="curp" >{{ __('CURP') }}</label>

                                <div class="col-md-6">
                                    <input id="curp" type="text" class="form-control @error('curp') is-invalid @enderror" name="curp" value="{{ old('curp') }}" required autocomplete="curp" autofocus>

                                    @error('curp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                    
                            <div class="form-group ">
                            <label for="rol" >{{ __('Expediente') }}</label>

                            <div class="col-md-6"> 
                                <select name="expedientes_id" id="expedientes_id" class="form-control">
                                    @foreach ($rs_expediente as $expediente) 
                                      <option value="{{ $expediente->id }}">{{ $expediente->folio}}</option>
                                     @endforeach
                                </select> 
                                
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="email" >{{ __('Correo electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  required autocomplete="email" disabled>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="password">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" disabled>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" >{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" disabled>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer" align="right"> 
                      <a href="{{ url( 'usuarios/admin')}}"" class="btn btn-dark" ><i class="fas fa-check-circle"></i>Aceptar</a> 
            </div>
        </div>
  
@endsection
