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
            <li class="{{ in_array(Request::segment(1), ['actividades', 'municipios', 'departamentos', 'sucursales']) ? 'active' : '' }}">

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

                    {{--<li class="{{ Request::segment(1) == 'puntosventa' ? 'active' : '' }}">
                        <a href="{{ route('puntosventa.index') }}"><i class="fa fa-circle-o"></i> Puntos de venta</a>
                    </li>--}}

                    <li class="{{ Request::segment(1) == 'sucursales' ? 'active' : '' }}">
                        <a href="{{ route('sucursales.index') }}"><i class="fa fa-circle-o"></i> Sucursales</a>
                    </li>
                </ul>
 
            </li> 

            </li>
        </ul>
    </li>

    {{-- Inventario --}}
    <li class="treeview {{ in_array(Request::segment(1), ['modelos','marcas','tipos','contadores','productos','estados']) ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-list"></i> <span>Inventario</span><i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu">
            {{-- Modulos Inventario --}}
            <li class="{{ in_array(Request::segment(1), ['productos']) ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-wpforms"></i> Modulos <i class="fa fa-angle-left pull-right"></i>
                </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::segment(1) == 'productos' ? 'active' : '' }}">
                            <a href="{{ route('productos.index') }}"><i class="fa fa-barcode"></i> Productos</a>
                    </li>
                </ul>
            </li>
        
           {{-- Referencias Inventario --}}
            <li class="{{ in_array(Request::segment(1), ['modelos','marcas','tipos','contadores','estados']) ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-circle-o"></i> Referencias <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::segment(1) == 'modelos' ? 'active' : '' }}">
                        <a href="{{ route('modelos.index') }}"><i class="fa fa-circle-o"></i> Modelos</a>
                    </li>
                    <li class="{{ Request::segment(1) == 'estados' ? 'active' : '' }}">
                        <a href="{{ route('estados.index') }}"><i class="fa fa-circle-o"></i> Estados</a>
                    </li>
                    <li class="{{ Request::segment(1) == 'marcas' ? 'active' : '' }}">
                        <a href="{{ route('marcas.index') }}"><i class="fa fa-circle-o"></i> Marcas</a>
                    </li>
                    <li class="{{ Request::segment(1) == 'tipos' ? 'active' : '' }}">
                        <a href="{{ route('tipos.index') }}"><i class="fa fa-circle-o"></i> Tipos</a>
                    </li>
                    <li class="{{ Request::segment(1) == 'tipos' ? 'active' : '' }}">
                        <a href="{{ route('contadores.index') }}"><i class="fa fa-circle-o"></i> Contadores</a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

    {{-- Tecnico --}}
    <li class="treeview {{ in_array(Request::segment(1), ['contratos','ordenes','tiposorden','solicitantes','danos','prioridades','zonas','asignaciones']) ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-cogs"></i> <span>Tecnico</span><i class="fa fa-angle-left pull-right"></i>
        </a>

        <ul class="treeview-menu">
            {{-- Modulos Tecnico --}}
            <li class="{{ in_array(Request::segment(1), ['contratos','ordenes','asignaciones']) ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-wpforms"></i> Modulos <i class="fa fa-angle-left pull-right"></i>
                </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::segment(1) == 'contratos' ? 'active' : '' }}">
                            <a href="{{ route('contratos.index') }}"><i class="fa fa-briefcase"></i> Contratos</a>
                        </li>

                        <li class="{{ Request::segment(1) == 'ordenes' ? 'active' : '' }}">
                        <a href="{{ route('ordenes.index') }}"><i class="fa fa-building-o"></i> Ordenes</a>
                        </li>

                        <li class="{{ Request::segment(1) == 'asignaciones' ? 'active' : '' }}">
                        <a href="{{ route('asignaciones.index') }}"><i class="fa fa-cube"></i> Asignacion</a>
                        </li>
                </ul>
            </li>
      
            {{-- Referencias Tecnico --}}
            <li class="{{ in_array(Request::segment(1), ['tiposorden','solicitantes','danos','prioridades','zonas']) ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-circle-o"></i> Referencias <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::segment(1) == 'tiposorden' ? 'active' : '' }}">
                        <a href="{{ route('tiposorden.index') }}"><i class="fa fa-circle-o"></i> Tipo de Orden</a>
                    </li>
                    <li class="{{ Request::segment(1) == 'solicitantes' ? 'active' : '' }}">
                        <a href="{{ route('solicitantes.index') }}"><i class="fa fa-circle-o"></i> Solicitantes</a>
                    </li>
                    <li class="{{ Request::segment(1) == 'danos' ? 'active' : '' }}">
                        <a href="{{ route('danos.index') }}"><i class="fa fa-circle-o"></i> Daños</a>
                    </li>
                    <li class="{{ Request::segment(1) == 'prioridades' ? 'active' : '' }}">
                        <a href="{{ route('prioridades.index') }}"><i class="fa fa-circle-o"></i> Prioridades</a>
                    </li>
                    <li class="{{ Request::segment(1) == 'zonas' ? 'active' : '' }}">
                        <a href="{{ route('zonas.index') }}"><i class="fa fa-circle-o"></i> Zonas</a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    
</ul>

        
    

