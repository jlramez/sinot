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
@extends('layouts.app')

@section('content')

            <div class="card">
                <div class="card-header">{{ __('Nueva Notificación') }}</div>

                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert" >
                            {{ session('status')}}
                        </div>
                     @endif
                    <form method="POST" action="{{route('store_notificacion') }}">
                        @csrf

                        <div class="form-group ">
                            <label for="am" >{{ __('Seleccione un medio de impugnación:') }}</label>

                            <div class="">
                                  <select name="puestos_id" id="puestos_id">
                                    @foreach ($rsexp as $expediente) 
                                      <option value="{{ $expediente->id }}">{{ $expediente->folio }}</option>
                                     @endforeach
                                </select> 
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group ">
                            <label for="am" >{{ __('Actuación:') }}</label>

                            <div class="">
                                  <select name="puestos_id" id="puestos_id">
                                    @foreach ($rsact as $actuacion) 
                                      <option value="{{ $actuacion->id }}">{{ $actuacion->Nombre }}</option>
                                     @endforeach
                                </select> 
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="ap" >{{ __('Magistrado Instructor') }}</label>

                            <div class="">
                                <input id="ap" type="text" class="form-control @error('ap') is-invalid @enderror" name="ap" value="{{ old('ap') }}" required autocomplete="ap">

                                @error('ap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group ">
                            <label for="am" >{{ __('Responsable Notificación') }}</label>

                            <div class="">
                                <input id="am" type="text" class="form-control @error('am') is-invalid @enderror" name="am" value="{{ old('am') }}" required autocomplete="am">

                                @error('am')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                         <div class="form-group ">
                            <label for="am" >{{ __('Leída (Sí/No):') }}</label>

                            <div class="">
                                <input id="magistrado" type="text" class="form-control @error('magistrado') is-invalid @enderror" name="magistrado" value="{{ old('magistrado') }}" required autocomplete="magistrado">

                                @error('magistrado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                         <div class="form-group ">
                            <label for="am" >{{ __('Actor Responsable:') }}</label>

                            <div class="">
                                <input id="curp" type="text" class="form-control @error('curp') is-invalid @enderror" name="curp" value="{{ old('curp') }}" required autocomplete="curp">

                                @error('curp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        



                        <div class="form-group ">
                            <label for="am" >{{ __('Correo electrónico:') }}</label>

                            <div class="">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Guardar Cambios') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
