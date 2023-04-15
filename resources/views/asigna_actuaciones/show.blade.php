@extends('adminlte::page')

@section('title', ' Asigna actuaciones')

@section('content_header')
<h1><i class="fas fa-folder">Asignar actuaciones a expediente </i></h1>
@stop

@section('content')

    <div class="container">
            <div class="col-md-18">
                <h3>{{ $expediente->folio}}</h3>
                <div class="card"> 
                @if (session('status'))
                    @if (session('type'))
                            <div class="{{session('type')}}" role="alert">
                                {{ session('status')}}
                            </div>

                    @endif
                @endif

                   <div class="card-header" align="right">
                   <a href="{{ url('/addact/create/'.$expediente->id) }}" class="btn btn-success" ><i class="fas fa-plus-circle"></i>Agregar Actuación</a> 
                    <div class="card-body" >
                         <p><h4>Actuaciones realizadas:</h4></p>
                         <table class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Expediente</th>
                                        <th>Actuacion</th>
                                       <th>Actor / Denunciante</th>
                                       <th>A.R. / Denunciado</th>
                                       <th>Estátus</th>                                     
                                       <th>Archivo Adjunto</th>
                                        <th>Autorizar</th>
                                        <th>Editar</th>
                                        <th>Notificación</th>
                                        <th>Borrar</th>                                  
                                        
                                    
                                    </tr>
                                </thead>
                                    @foreach($aa as $actuacion)                                    
                                        <tr>
                                        <td>
                                                {{$actuacion->id}}                                        
                                            </td>
                                            <td>
                                            <a href="{{ url('/asigna_actuaciones/show/'.$actuacion->id) }}">{{$actuacion->folio}}</a>                                        
                                            </td>
                                            <td>
                                                HOla                                      
                                            </td>
                                            <td>
                                                {{$expediente->actor}}                                        
                                            </td>
                                            <td>
                                                {{$expediente->denunciado}}                                        
                                            </td>
                                                @if($actuacion->autorizada==0)
                                                <td ><span class="badge badge-danger">No Autorizada</span></td>
                                                @endif
                                                @if($actuacion->autorizada==1)
                                                <td><span class="badge badge-success">Autorizada</span></td>
                                                @endif  
                                                <!--<td align="center">
                                                <a href="{{url('/storage/'.$actuacion->nombre_dcto_app)}}">{{$actuacion->nombre_dcto}}</a>
                                            </td>  -->
                                                <td align="center">
                                                <a href="{{ url('/asigna_actuaciones/'.$actuacion->id.'/edit') }}" class="btn btn-warning" ><i class="fas fa-power-off"></i></a>  
                                            </td>                                                                              
                                           
                                            <td align="center">
                                                <a href="{{ url('/asigna_actuaciones/'.$actuacion->id.'/edit_actuaciones') }}" class="btn btn-dark" ><i class="fas fa-edit"></i></a>  
                                            </td>
                                            <td  align="center">
                                            <a href="{{ url('/notificacion/create/'.$actuacion->id) }}" class="btn btn-dark" ><i class="fas fa-file-import"></i></a>  
                                            </td>
                                            <td  align="center">
                                                <a href="{{ url('/asigna_actuaciones/'.$actuacion->id) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')"   class="btn btn-danger" ><i class="fas fa-minus-circle"></i></a>  
                                            </td>
                                           
                                        </tr>
                                
                                     @endforeach
                            </table>
                    </div>

                    
                    <div class="card-footer" align="right">  
                          
                      <a href="{{ url('/expedientes/admin') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
