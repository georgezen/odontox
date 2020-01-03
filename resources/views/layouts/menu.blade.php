

<li>
	<a href="#" data-toggle="collapse" data-target="#toggleDemo1" data-parent="#sidenav01" class="collapsed">
		<span class="fa fa-credit-card"></span> VENTAS <span class="caret pull-right"></span>
	</a>
	<div class="collapse" id="toggleDemo1" style="height: 0px;">
		<ul class="nav nav-list">
			<li class="{{ Request::is('ventas*') ? 'active' : '' }}">
				<a href="{!! route('ventas') !!}"><span style="margin-left: 45px;">Listado de Ventas</span></a>
			</li>
			<li class="{{ Request::is('clientes*') ? 'active' : '' }}">
				<a href="{!! route('clientes') !!}"><span style="margin-left: 45px;">Clientes</span></a>
			</li>
	
		</ul>
	</div>
</li>


<li>
	<a href="#" data-toggle="collapse" data-target="#toggleDemo2" data-parent="#sidenav01" class="collapsed">
		<span class="fa fa-cart-plus"></span> COMPRAS <span class="caret pull-right"></span>
	</a>
	<div class="collapse" id="toggleDemo2" style="height: 0px;">
		<ul class="nav nav-list">
			<li class="{{ Request::is('compras*') ? 'active' : '' }}">
				<a href="{!! route('compras') !!}"><span style="margin-left: 45px;">Listado compras</span></a>
			</li>
			<li class="{{ Request::is('proveedores*') ? 'active' : '' }}">
				<a href="{!! route('proveedores') !!}"><span style="margin-left: 45px;">Proveedores</span></a>
			</li>
			<li class="{{ Request::is('productos*') ? 'active' : '' }}">
				<a href="{!! route('productos') !!}"><span style="margin-left: 45px;">Productos</span></a>
			</li>

			<li class="{{ Request::is('presentacionProducto*') ? 'active' : '' }}">
				<a href="{!! route('presentacionProducto') !!}"><span style="margin-left: 45px;">Presentaciones</span></a>
			</li>
		</ul>
	</div>
</li>



<li>
	<a href="#" data-toggle="collapse" data-target="#toggleDemo3" data-parent="#sidenav01" class="collapsed">
		<span class="glyphicon glyphicon-cog"></span> ADMINISTRACION <span class="caret pull-right"></span>
	</a>
	<div class="collapse" id="toggleDemo3" style="height: 0px;">
		<ul class="nav nav-list">
			<li class="{{ Request::is('sucursales*') ? 'active' : '' }}">
				<a href="{!! route('sucursales.index') !!}"><span style="margin-left: 45px;">Sucursales</span></a>
			</li> 
			<li class="{{ Request::is('usuarios*') ? 'active' : '' }}">
				<a href="{!! route('usuarios.index') !!}"><span style="margin-left: 45px;">Usuarios</span></a>
			</li>
			<li class="{{ Request::is('roles*') ? 'active' : '' }}">
				<a href="{!! route('roles') !!}"><span style="margin-left: 45px;">Roles</span></a>
			</li>
			<li class="{{ Request::is('trabajadores*') ? 'active' : '' }}">
				<a href="{!! route('trabajadores.index') !!}"><span style="margin-left: 45px;">Trabajadores</span></a>
			</li>
		</ul>
	</div>
</li>


<li>
	<a href="{{ route('almacen')}}" data-toggle="collapse" data-target="#toggleDemo4" data-parent="#sidenav01" class="collapsed">
		<span class="glyphicon glyphicon-cog"></span> ALMACÉN<span class="caret pull-right"></span>
	</a>
	
</li>








