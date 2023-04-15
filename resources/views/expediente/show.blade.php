@extends('adminlte::page')

@section('title', ' Ver Expedientes')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-folder">Detalle del expediente </i></h1></font>
@stop

@section('content')
    
              
                <div class="card"> 
                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                   <div class="card-header">
          
                                Expediente: {{$expediente->folio }}
                  </div>
                                  <div class="card-body" >
                    <div class="panel panel-default">
                     <div class="panel-body">
                                  <label>TIpo de Juicio:</label>
                                  <P> {{$expediente->juicios->nomenclatura}}</p>
                                 <label>Interposición:</label>
                                 <P>{{$expediente->interposicion->descripcion}}</p>
                                  <label>Actor:</label>
                                  <P>{{$expediente->actor}}</p>
                                  <label>Denunciado:</label>
                                  <P>{{$expediente->denunciado}}</p>
                                  <label>Acción:</label>
                                  <P>{{$expediente->accion}}</p>
                                  <label>T. Interesados:</label>
                                  <P>{{$expediente->terceros_interesados}}</p>
                                  <label>Sexo:</label>
                                  @if($expediente->sexo==0)
                                  <p>MUJER</p>
                                  @endif
                                  @if($expediente->sexo==1)
                                  <p>HOMBRE</p>
                                  @endif
                                  @if($expediente->sexo==2)
                                  <p>INSTITUCION</p>
                                  @endif
                                  @if($expediente->sexo==3)
                                  <p>PARTIDO POLÍTICO</p>
                                  @endif
                                  <label>Fecha:</label>
                                  <p>{{$expediente->fecha}}</p>
                                  <label>Hora:</label>
                                  <p>{{$expediente->hora}}</p>                         
                                  <!-- <td>{{$expediente->users_id }}</td>
                                  <td>{{$expediente->ponencias_id}}</td>
                                  <td>{{$expediente->juicios_id}}</td>--></div>
 
</div>
                    <!-- <td>{{$expediente->id }}</td>-->
                                  
                          
                        
                    </div>                    
                    <div class="card-footer" align="right">    
                      <a href="{{ url('/expedientes/admin') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
                </div>
            

@endsection