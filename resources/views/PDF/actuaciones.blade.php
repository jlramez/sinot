<!DOCTYPE html>
    <html lang="en">
            <head>
                <meta charset='UTF-8'>
                    <title> ACUSE ENTREGA DE DATOS PARA USUARIO DEL SISTEMA DE NOTIFICACIÓN ELECTRÓNICA </title>
                    <style>
                            #div1, #div2, #div3 {background-color: #f4f4f4; margin: 2px; width: 150px; height: 80px;}
                            #div2 {margin-top: 0px; margin-bottom: 0px; !important}
                    </style>
                </head>
<body>
    <div class="card">
            <div Class="card-header">
            
            <img src="../public/img/logo_trijez.png" width="180" height="60">
                <h4 align="center"> SISTEMA DE NOTIFICACIÓN ELECTRÓNICA DEL TRIBUNAL DE JUSTICIA ELECTORAL DEL ESTADO DE ZACATECAS</h4>
                <div align="right"> 
        
                Folio : TRIJEZ/UI/000{{$documentos->id}}
                </div>
                <div align="right"> 
                Fecha : {{now()}}
                </div>
            </div>
            <div class="card-body">
                        <table border="0" width="100%">
                            <thead>
                           
                            </thead>
                            <tbody>
                            <tr>
                                    <td colspan="2" bgcolor="gray" align="center"><b><font color="white">{{$documentos->asigna_actuaciones->actuacions->Nombre}}</font></b></td>
                                </tr>
                                <tr>
                                        <td colspan="2">&nbsp;</td> 
                                </tr> 
                                <tr>
                                    <td><b>TIPO DE JUICIO:</b></td> <td>{{$documentos->asigna_actuaciones->expedientes->juicios->descripcion}}</td>
                                </tr>
                                <tr>
                                    <td><b>EXPEDIENTE:</b></td> <td>{{$documentos->asigna_actuaciones->expedientes->folio}}</td>
                                </tr>                      
                                <tr>
                                    <td><b>ACTOR:</b></td><td>{{$documentos->asigna_actuaciones->expedientes->actor}}</td>
                                </tr>
                                <tr>
                                    <td><b>AUTORIDAD RESPONSABLE:</b></td><td>{{$documentos->asigna_actuaciones->expedientes->denunciado}}</td>
                                </tr>
                                <tr>
                                    <td><b>MAGISTRADO:</b></td><td>{{$documentos->asigna_actuaciones->expedientes->ponencias->magistrados->nombre}} 
                                    {{$documentos->asigna_actuaciones->expedientes->ponencias->magistrados->primerapellido}} 
                                    {{$documentos->asigna_actuaciones->expedientes->ponencias->magistrados->segundoapellido}}
                                    </td>
                                </tr>
                                <tr>
                                        <td colspan="2">&nbsp;</td> 
                                </tr> 
                                <tr>
                                        <td colspan="2">&nbsp;</td> 
                                </tr> 
                                <tr>
                                        <td colspan="2">&nbsp;</td> 
                                </tr> 
                                <tr>
                                <td colspan="2"" align="center">{{$documentos->cuerpo}}</td>
                                </tr>
                                <tr>
                                        <td colspan="2">&nbsp;</td> 
                                </tr> 
                                <tr>
                                        <td colspan="2">&nbsp;</td> 
                                </tr> 
                                <tr>
                                        <td colspan="2">&nbsp;</td> 
                                </tr> 
                                <tr>
                                        <td>
                                            @foreach ($rsaf as $firmas) 
                                                <tr>
                                                    <td colspan="2"" align="center">
                                                        <b>{{$firmas->empleados->nombre}}  {{$firmas->empleados->ap}}  {{$firmas->empleados->am}}</B>
                                                    </td>
                                                    <tr>
                                                            <td colspan="2"" align="center"><i class="fas fa-check-circle" ></i>{{$efirma}}</td> 
                                                    </tr> 
                                                    <tr>
                                                            <td >&nbsp;</td> 
                                                    </tr> 
                                                   
                                                    
                                                </tr>
                                                    @endforeach
                                        </td>
                                </tr>
                            </tbody>
                            <tfoot>                           
                                <tr>
                                        <td colspan="2">&nbsp;</td> 
                                </tr>                      
                                <tr>
                                        <td  <td colspan="2"" align="center"><b>Imprime documento</b></td> 
                                </tr>
                                <tr>
                                        <td  <td colspan="2" align="center"><b>{{$print_user_name}}</b></td> 
                                </tr>
                                <tr>
                                        <td colspan="2">&nbsp;</td> 
                                </tr> 
                                <tr>
                                        <td colspan="2" align="left"><img src="../public/qrcodes/qrcode.svg"></img></td> 
                                </tr>
                                <tr>
                                        <td colspan="2" align="left">http://trijez.mx</img></td> 
                                </tr>
                                
                            </tfoot>
    
                        </table>

                        
           
    </div>

</body>
                    
    </html>                