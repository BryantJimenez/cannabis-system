<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="profile-info">
            <figure class="user-cover-image"></figure>
            <div class="user-info">
                <img src="{{ image_exist('/admins/img/users/', Auth::user()->photo, true) }}" width="90" height="90" title="Foto de Perfil" alt="{{ Auth::user()->name." ".Auth::user()->lastname }}">
                <h6 class="">{{ Auth::user()->name." ".Auth::user()->lastname }}</h6>
                <p class="">{!! roleUser(Auth::user()) !!}</p>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu {{ active(['admin', 'admin/perfil', 'admin/perfil/editar']) }}">
                <a href="{{ route('admin') }}" aria-expanded="{{ menu_expanded(['admin', 'admin/perfil', 'admin/perfil/editar']) }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span> Inicio</span>
                    </div>
                </a>
            </li>

            @if(auth()->user()->can('stages.cured.index') || auth()->user()->can('stages.trimmed.index'))
            <li class="menu {{ active('admin/etapas', 0) }}">
                <a href="#stages" data-toggle="collapse" aria-expanded="{{ menu_expanded('admin/etapas', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-repeat"><polyline points="17 1 21 5 17 9"></polyline><path d="M3 11V9a4 4 0 0 1 4-4h14"></path><polyline points="7 23 3 19 7 15"></polyline><path d="M21 13v2a4 4 0 0 1-4 4H3"></path></svg>
                        <span> PosCosecha</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ submenu('admin/etapas', 0) }}" id="stages" data-parent="#accordionExample">
                    @can('stages.cured.index')
                    <li {{ submenu('admin/etapas/curado') }}>
                        <a href="{{ route('stages.cured.index') }}"> Curado</a>
                    </li>              
                    @endcan
                    @can('stages.trimmed.index')     
                    <li {{ submenu('admin/etapas/trimmiado') }}>
                        <a href="{{ route('stages.trimmed.index') }}"> Trimmiado</a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endif

            @can('statistics.index')
            <li class="menu {{ active('admin/estadisticas') }}">
                <a href="{{ route('statistics.index') }}" aria-expanded="{{ menu_expanded('admin/estadisticas') }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                        <span> Estadísticas</span>
                    </div>
                </a>
            </li>
            @endcan

            @if(auth()->user()->can('users.index') || auth()->user()->can('employees.index'))
            <li class="menu {{ active(['admin/usuarios', 'admin/trabajadores'], 0) }}">
                <a href="#users" data-toggle="collapse" aria-expanded="{{ menu_expanded(['admin/usuarios', 'admin/trabajadores'], 0) }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <span> Usuarios</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ submenu(['admin/usuarios', 'admin/trabajadores'], 0) }}" id="users" data-parent="#accordionExample">
                    @can('users.index')
                    <li {{ submenu('admin/usuarios') }}>
                        <a href="{{ route('users.index') }}"> Administradores</a>
                    </li>              
                    @endcan
                    @can('employees.index')     
                    <li {{ submenu('admin/trabajadores') }}>
                        <a href="{{ route('employees.index') }}"> Trabajadores</a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endif

            @if(auth()->user()->can('settings.edit') || auth()->user()->can('harvests.index') || auth()->user()->can('strains.index') || auth()->user()->can('rooms.index') || auth()->user()->can('containers.index'))
            <li class="menu {{ active(['admin/ajustes', 'admin/cosechas', 'admin/cepas', 'admin/cuartos', 'admin/recipientes'], 0) }}">
                <a href="#cogs" data-toggle="collapse" aria-expanded="{{ menu_expanded(['admin/ajustes', 'admin/cosechas', 'admin/cepas', 'admin/cuartos', 'admin/recipientes'], 0) }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                        <span> Configuraciones</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ submenu(['admin/ajustes', 'admin/cosechas', 'admin/cepas', 'admin/cuartos', 'admin/recipientes'], 0) }}" id="cogs" data-parent="#accordionExample">
                    @can('settings.edit')
                    <li {{ submenu('admin/ajustes') }}>
                        <a href="{{ route('settings.edit') }}"> Generales</a>
                    </li>              
                    @endcan
                    @can('harvests.index')
                    <li {{ submenu('admin/cosechas') }}>
                        <a href="{{ route('harvests.index') }}"> Cosechas</a>
                    </li>              
                    @endcan
                    @can('strains.index')     
                    <li {{ submenu('admin/cepas') }}>
                        <a href="{{ route('strains.index') }}"> Cepas</a>
                    </li>
                    @endcan
                    @can('rooms.index')     
                    <li {{ submenu('admin/cuartos') }}>
                        <a href="{{ route('rooms.index') }}"> Cuartos</a>
                    </li>
                    @endcan
                    @can('containers.index')     
                    <li {{ submenu('admin/recipientes') }}>
                        <a href="{{ route('containers.index') }}"> Recipientes</a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endif

            @if(auth()->user()->can('records.cured.index') || auth()->user()->can('records.trimmed.index'))
            <li class="menu {{ active('admin/registros', 0) }}">
                <a href="#records" data-toggle="collapse" aria-expanded="{{ menu_expanded('admin/registros', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                        <span> Registros</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ submenu('admin/registros', 0) }}" id="records" data-parent="#accordionExample">
                    @can('records.cured.index')
                    <li {{ submenu('admin/registros/curado') }}>
                        <a href="{{ route('records.cured.index') }}"> Curado</a>
                    </li>              
                    @endcan
                    @can('records.trimmed.index')     
                    <li {{ submenu('admin/registros/trimmiado') }}>
                        <a href="{{ route('records.trimmed.index') }}"> Trimmiado</a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endif

            @can('logs.index')
            <li class="menu {{ active('admin/bitacora') }}">
                <a href="{{ route('logs.index') }}" aria-expanded="{{ menu_expanded('admin/bitacora') }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                        <span> Bitacora</span>
                    </div>
                </a>
            </li>
            @endcan
        </ul>

    </nav>

</div>