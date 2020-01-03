<div class="table-responsive">
    <table class="table table-hover table-bordered" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Folio</th>
                <th>Comprobante</th>
                <th>Proveedor</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="info_compras">
            @foreach($compras as $compra)
            <tr>
                <td>{{ $compra->id_compra }}</td>
                <td>{{ $compra->folio }}</td>
                <td>{{ $compra->comprobante }}</td>
                <td>{{ $compra->fullname }}</td>
                <td>{{ "$ ".$compra->total }}</td>
                <td><button class="btn btn-primary detalle_compra" id="detalle_compra" data-id="{{ $compra->id_compra }}" data-toggle="modal" data-target="#miModal"> <i class="fa fa-eye"></i> </button></td>
            </tr>

            @endforeach
        </tbody>
    </table>
    {{ $compras->render() }}   
    <strong class="pull-right" id="counts">{{ $count." Compras" }}</strong>     
</div>