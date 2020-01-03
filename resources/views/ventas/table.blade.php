<div class="table-responsive">
    <table class="table table-hover table-bordered" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Folio</th>
                <th>Comprobante</th>
                <th>Cliente</th>
                
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="info_compras">
            @foreach($ventas as $venta)
            <tr>
                <td>{{ $venta->id_venta }}</td>
                <td>{{ $venta->folio }}</td>
                <td>{{ $venta->tipo_comprobante }}</td>
                
                <td>{{ $venta->fullname }}</td>
                <td>{{ $venta->total }}</td>
                <td><button class="btn btn-primary detalle_venta" id="detalle_venta" data-id="{{ $venta->id_venta }}" data-toggle="modal" data-target="#miModal"> <i class="fa fa-eye"></i> </button></td>
            </tr>

            @endforeach
        </tbody>
    </table>
    {{ $ventas->render() }}   
    <strong class="pull-right" id="counts">{{ $count." Ventas" }}</strong>     
    
             
</div>