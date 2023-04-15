<style>
    .btn-trijez {
  color: #cccccc;
  background-color: #367068;
  border-color: #367068;
}
.btn-trijez:hover {
  color: #fff;
  background-color: #367068;
  border-color: #367068;
}
.card-header-trijez {
  padding: 0.75rem 1.25rem;
  margin-bottom: 0;
  background-color: rgba(54, 112, 104, 0.65);
  border-bottom: 1px solid rgba(54, 112, 104, 0.125);
  color: #ffffff
}
textarea:focus, input:focus, input[type]:focus 
      {
            border-color: rgb(54, 112, 104);
            box-shadow: 0 1px 1px rgba(54, 112, 104, 0.075)inset, 0 0 8px rgba(54, 112, 104,0.6);
            outline: 0 none;

       }
    
       option:hover {
         background:green
        }
p {
                  
                    line-height: 50%   /*esta es la propiedad para el interlineado*/
                   
                }
</style>
@extends('layouts/index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header-trijez">{{ __('Acceso') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn-trijez">
                                    {{ __('Ingresar') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                      
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
        <div class="card-footer">
            <div class="links" align="center">
                <a href="#">Enlaces de interés</a>
            </div>

                <div>&nbsp;</div>
                <div>&nbsp;</div>

                <div class="links" align="center">
                    <a href="http://2020v03.transparencia-trijez.mx/index.php/reviews/btn-sentencias-2">Normatividad</a>
                    <a href="https://trijez.mx">Trijez.mx</a>
                    <a href="http://www.zacatecas.gob.mx">Gobierno del Estado </a>
                    <a href="https://www.plataformadetransparencia.org.mx/web/guest/inicio">SIPOT</a>
                    <a href="https://www.tsjzac.gob.mx/">Poder Judicial Zacatecas</a>
                    <a href="https://www.te.gob.mx/">Tribunal Electoral </a>
                    
                </div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
             
                <div align="center">
                        <p>Tribunal de Justicia Electoral del Estado de Zacatecas. Tels: 492 9226136 - 492 9224558</p>
                        <p>Av. Pedro Coronel #114, Fracc. Los Geranios, Guadalupe, Zacatecas. CP 98619 </p>
                        <p><b>© Todos los derechos reservados 1998-2021 </b></p>
                </div>
            
        </div>
@endsection
