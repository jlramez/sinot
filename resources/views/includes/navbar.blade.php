  <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif

                        @else


                             <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="fas fa-users-cog"></i>
                                    {{ 'Administrar' }} <span class="caret"></span>
                                </a>


                                <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin_actuacion') }}">
                                        {{ __('Actuaciones') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin_area') }}">
                                        {{ __('Áreas') }}
                                    <a class="dropdown-item" href="{{ route('admin_empleado') }}">
                                        {{ __('Destinatarios Notificación Electrónica') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin_destinatario') }}">
                                        {{ __('Empleados') }}
                                    </a> 
                                    <a class="dropdown-item" href="{{ route('admin_estatus') }}">
                                        {{ __('Estátus') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin_expediente') }}">
                                        {{ __('Expedientes') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin_interposicion') }}">
                                        {{ __('Interposición') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin_juicio') }}">
                                        {{ __('Juicios') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin_magistrado') }}">
                                        {{ __('Magistrados') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin_notificacion') }}">
                                        {{ __('Notificaciones') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin_ponencia') }}">
                                        {{ __('Ponencias') }}
                                    </a>
                                     <a class="dropdown-item" href="{{ route('admin_puesto') }}">
                                        {{ __('Puestos') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin_rol') }}">
                                        {{ __('Roles Usuario') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin_tarea') }}">
                                        {{ __('Tareas') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin_user') }}">
                                        {{ __('Usuarios') }}
                                    </a>
                                 
                                    
                                   
                                     
                                     
                                   
                                     
                                </div>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                </div>


                            </li>


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="fas fa-user-circle"></i>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                </div>
                            </li>
                        @endguest
                    </ul>