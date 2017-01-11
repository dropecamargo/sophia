<ul class="sidebar-menu">
    <li class="header">Menú de navegación</li>
    <li class="{{ Request::route()->getName() == 'dashboard' ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard </span></a>
    </li>

    {{-- Administracion --}}
    <li class="treeview {{ in_array(Request::segment(1), ['empresa', 'terceros', 'actividades', 'municipios', 'departamentos', 'sucursales']) ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}">
            <i class="fa fa-cog"></i> <span>Administración</span><i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu">
            {{-- Modulos administracion --}}
            <li class="{{ in_array(Request::segment(1), ['empresa', 'terceros']) ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-wpforms"></i> Módulos <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    {{-- <li class="{{ Request::segment(1) == 'empresa' ? 'active' : '' }}">
                        <a href="{{ route('empresa.index') }}"><i class="fa fa-building"></i> Empresa</a>
                    </li> --}}
                    <li class="{{ Request::segment(1) == 'terceros' ? 'active' : '' }}">
                        <a href="{{ route('terceros.index') }}"><i class="fa fa-users"></i> Terceros</a>
                    </li>
                </ul>
            </li>

            {{-- Referencias administracion --}}
            {{-- <li class="{{ in_array(Request::segment(1), ['actividades', 'municipios', 'departamentos', 'sucursales']) ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-circle-o"></i> Referencias <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::segment(1) == 'actividades' ? 'active' : '' }}">
                        <a href="{{ route('actividades.index') }}"><i class="fa fa-circle-o"></i> Actividades</a>
                    </li>
                    <li class="{{ Request::segment(1) == 'departamentos' ? 'active' : '' }}">
                        <a href="{{ route('departamentos.index') }}"><i class="fa fa-circle-o"></i> Departamentos</a>
                    </li>
                    <li class="{{ Request::segment(1) == 'municipios' ? 'active' : '' }}">
                        <a href="{{ route('municipios.index') }}"><i class="fa fa-circle-o"></i> Municipios</a>
                    </li>
                    <li class="{{ Request::segment(1) == 'puntosventa' ? 'active' : '' }}">
                        <a href="{{ route('puntosventa.index') }}"><i class="fa fa-circle-o"></i> Puntos de venta</a>
                    </li>
                    <li class="{{ Request::segment(1) == 'sucursales' ? 'active' : '' }}">
                        <a href="{{ route('sucursales.index') }}"><i class="fa fa-circle-o"></i> Sucursales</a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </li>
</ul>