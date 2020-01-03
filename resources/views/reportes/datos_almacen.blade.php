
@extends('reportes.index')

@section('body_reporte')
<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>Id:</th>
				<th>Código</th>
				<th>Nombre | Descripción</th>
				<th>Stock</th>
			</tr>
		</thead>
		<tbody>
			@foreach($productos as $producto)
				<tr>
					<td>{{ $producto->id_producto }}</td>
					<td>{{ $producto->codigo }}</td>
					<td>{{ $producto->nombre." | ".$producto->descripcion }}</td>
					<td>{{ $producto->stock }}</td>
				</tr>

			@endforeach
			
		</tbody>
	</table>
@endsection