<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use DateTime;
use App\accesos;
class SuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        //$ip_client=getClientIps();
        $ip_client=$this->getVisitorIp();
        //dd($ip_client);
        /*$accesos=new accesos;
        $accesos->user_id=auth()->user()->id;
        $accesos->ip=$ip_client;
        $accesos->last_login = now();
        $accesos->save();*/
        $register = accesos::create([
          'user_id' => auth()->user()->id,
          'ip' => $ip_client,
          'last_login' => new DateTime,
          'last_created_at' => new DateTime,
          'last_updated_at' => new DateTime
      ]);

        $event->user->last_login = now();
        $event->user->save();
    }
    public function accesso(Login $event)
    {
        
        $event->user->last_login = new DateTime;
        $event->user->save();
    }

    function getVisitorIp()
    {
      // Recogemos la IP de la cabecera de la conexión
      if (!empty($_SERVER['HTTP_CLIENT_IP']))   
      {
        $ipAdress = $_SERVER['HTTP_CLIENT_IP'];
      }
      // Caso en que la IP llega a través de un Proxy
      elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
      {
        $ipAdress = $_SERVER['HTTP_X_FORWARDED_FOR'];
      }
      // Caso en que la IP lleva a través de la cabecera de conexión remota
      else
      {
        $ipAdress = $_SERVER['REMOTE_ADDR'];
      }
      return $ipAdress;
    }
}
