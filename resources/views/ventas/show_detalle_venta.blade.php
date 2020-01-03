@section('modal-add-contenido')

<table class="table table-hover table-bordered" id="detalles_show">
	<thead style="background-color: #A9D0F5;">
		<tr>

			<th>Cant.</th>
			<th>Producto:</th>
			<th>Precio Venta:</th>
			<th>Descuento:</th>
			<th>Subtotal:</th>
		</tr>
	</thead>
	<tfoot>
		<tr>

			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th>$ <strong id="total">0.00</strong></th>
		</tr>
	</tfoot>
	<tbody id="detalle_vent">
       
        

    </tbody>

</table>

@endsection