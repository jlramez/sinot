<html>
<head>
{!! htmlScriptTagJsApi(['action' => 'homepage']) !!}
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script> 
<title>.:SINOT.Sistema de Notificación Electrónica del Tribunal de Justicia Electoral del Estado de Zacatecas:.</title>
<meta http-equiv="Content-Type" content="text/html;">
<!-- Fireworks MX Dreamweaver MX target.  Created Tue May 25 13:57:23 GMT-0500 (Hora de verano central (M�xico)) 2021-->
</head>
<body bgcolor="#e8e8e8">

    <div  align="center">
      <img name="index_r1_c1" src="img/index_r1_c1.gif" width="1024" height="130" border="0" alt="">
    </div>
    <br>
    <br>
    <br>

      <div style="float:left;width: 100%; background-color: white; font-family:  Calibri;" align="center"> 
            @yield('content')            
      </div> 

     
      <div>&nbsp;</div>
      <div>&nbsp;</div>
      <div>&nbsp;</div>
    
      <div>&nbsp;</div>
      <div>&nbsp;</div>
     <div>
       @yield('footer')
    </div>
</body>
</html>
