<!DOCTYPE html>
    <html lang="en">
            <head>
              <style>
              p {
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 14px;
                    line-height: 120%   /*esta es la propiedad para el interlineado*/
                    color: #000;
                    padding: 10px;
                }
              </style>
                 <script>
                        var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                        var f=new Date();
                        document.write(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
                </script> 
                </head>
<body>
    <div class="card">
            <div Class="card-header">
            
           
            </div>
            <div class="card-body">
                        <table border="0" width="100%">
                            <thead>
                           
                            </thead>
                            <tbody>
                            <tr>
                                    <td >
                                        <p align="justify"><b>EL LICENCIADO CLEMENTE CRISTÓBAL HERNÁNDEZ, SECRETARIO GENERAL DE ACUERDOS DEL TRIBUNAL DE JUSTICIA ELECTORAL 
                                            DEL ESTADO DE ZACATECAS, HACE CONSTAR Y:</b>
                                            ------------------------------------------------------------ CERTIFICA: -------------------------------------
                                            ------------------
                                            QUE LA COPIA FOTOSTÁTICA QUE ANTECEDE CONSTANTE EN <b>{{$certificacion->fojas}} FOJA(S)</b>, ES COPIA FIEL DE LA VERSIÓN ORIGINAL DEL ACUERDO EMITIDO POR 
                                             LA MAGISTRADA ROCIO POSADAS RAMÍREZ PRESIDENTA DEL TRIBUNAL DE JUSTICIA ELECTORAL DEL ESTADO DE ZACATECAS DENTRO DEL <b>{{$certificacion->asigna_actuaciones->
                                            expedientes->juicios->descripcion}}</b> , 
                                            IDENTIFICADO CON LA CLAVE <b>{{$certificacion->asigna_actuaciones->folio}}</b> MISMO QUE SE TUVO A LA VISTA,  EN GUADALUPE, ZACATECAS EL  
                                            DÍA {{$fecha}}.    
                                            --------------------------------------------------------------------------------------------------------------------------------------------------
                                            -----------------------------------------------------------------------------------------------------------------------------------------.<p>
                                            <p align="justify">LO QUE SE HACE CONSTAR Y CERTIFICO  CON FUNDAMENTO EN LOS ARTÍCULOS 50 FRACCIONES III Y V ,
                                            DE LA LEY ORGÁNICA DEL TRIBUNAL DE JUSTICIA ELECTROAL DEL ESTADO DE ZACATECAS, ASÍ COMO 15 FRACCION I DEL
                                            REGLAMENTO INTERIOR DE ESTE TRIBUNAL, PARA EFECTOS LEGALES A QUE HAYA LUGAR . DOY FÉ 
                                            ------------------------------------------------------------------------------------------------------------------------------------------------.</p>

                                                                &nbsp;
                                                                &nbsp;
                                                                &nbsp;

                                                                <p align="center"><b>
                                                                LIC. CLEMENTE CRISTÓBAL HERNÁNDEZ 
                                                                    <BR>
                                                                   <br>SECRETARIO GENERAL DE ACUERDOS DEL
                                                                     <br>TRIBUNAL DE JUSTICIA ELECTORAL
                                                                        <br>DEL ESTADO DE ZACATECAS
                                                                </b></p>
                                        
                                    </td> 
                            </tr>
    
                        </table>

                        
           
            </div>

</body>
                    
    </html>                