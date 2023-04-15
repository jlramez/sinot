
@extends('adminlte::page')

@section('content')

            <div class="card">
                <div class="card-header">{{ __('Autorizar Documento para Certificación') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                         @endif
                    <form method="POST" action="{{url('/certificaciones/autorizar/'.$certificacion->id) }}">
                        @method('put')
                        @csrf

                        <div class="form-group ">
                            <label for="name">{{ __('Documento') }}</label>
                            <div class="">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                 name="name" value="{{ old('name', $certificacion->nombre_dcto )}}" required autocomplete="name" autofocus disabled >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group " >
                            <div class="col-md-6 offset-md-4" >
                                <button type="submit" class="btn btn-dark"><i class="fas fa-check-circle"></i>
                                    {{ __('Autorizar/No-Autorizar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer" align="right">     
                      <a href="{{ route( 'admin_certificacion')}}"" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                </div>
            </div>
      
@endsection