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
            <img src="../public/img/img/logo_trijez.png" width="180" height="60">
                <h3 align="center"> ACUSE ENTREGA DE DATOS PARA USUARIO DEL SISTEMA DE NOTIFICACIÓN ELECTRÓNICA</h3>
                <h4 align="center"> SISTEMA DE NOTIFICACIÓN ELECTRÓNICA DEL TRIBUNAL ELECTORAL DEL ESTADO DE ZACATECAS</h4>
                <div align="right"> 
         @foreach ($users as $user)
                Folio : TRIJEZ/UI/000{{$user->id}}
                </div>
                <div align="right"> 
                Fecha : {{now()}}
                </div>
            </div>
            <div class="card-body">
                        <table border="0" width="100%">
                            <thead>
                            <tr>
                                    <th colspan="2" >&nbsp;</th>
                                </tr>
                                <tr>
                                    <th colspan="2" bgcolor="gray">DATOS DEL USUARIO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Nombre del usuario</b></td> <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <td><b>CURP</b></td> <td>{{$user->CURP}}</td>
                                </tr>
                                </tr>
                                <tr>
                                    <td><b>Expediente(s):</b></td>
                                </tr>
                                @foreach($asigna_expedientes as $ae)   
                                <tr>
                                    <td>
                                            
                                        </td><td>{{$ae->expedientes->folio}}
                                              
                                    </td>
                                </tr>
                                @endforeach 
                                <tr>
                                    <td><b>Usuario</b></td><td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <td><b>Contraseña</b></td><td>{{$user->pwd_des}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="justify">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="justify">La información anterior, corresponde al usuario  que se indica , la cual tiene como objetivo proporcionar datos para 
                                     el ingreso al  "Sistema de Notificación Electrónica del Tribunal de Justicia Electoral del Estado de Zacatecas", por lo que a la recepción del presente,
                                    el usuario se hace responsable de  realizar revisiones periódicas dentro de la aplicación,  correspondientes a las actuaciones del medio de impugnacion 
                                    de interés. </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                        <td colspan="2" >&nbsp;</td>
                                </tr>
                                <tr>
                                        <td colspan="2">&nbsp;</td> 
                                </tr>
                                <tr>
                                        <td colspan="2">&nbsp;</td> 
                                </tr> 
                                <tr>
                                        <td  <td colspan="2"" align="center"><b>Nombre del Usuario</b></td> 
                                </tr>
                                <tr>
                                        <td  <td colspan="2" align="center"><b>{{$user->name}}</b></td> 
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
     @endforeach
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
                                        <td colspan="2">&nbsp;</td> 
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

                        
           
    </div>

</body>
</html>        