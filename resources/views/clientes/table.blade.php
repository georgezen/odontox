<div class="table-responsive">
    <table class="table table-hover table-bordered" >
        <thead>
            <tr>
                <th>ID:</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Telefono</th>
                <th>Calle</th>
                <th>Colonia</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="info_clientes">

            @foreach($clientes as $cliente)
                @if($cliente->activo == 1)
                    <tr class="{{ $cliente->id_cliente }}" style="background-color: green;">
                        <td>{{ $cliente->id_cliente }}</td>
                        <td>{{ $cliente->nombre." ".$cliente->ape_paterno." ".$cliente->ape_materno }}</td>
                        <td>{{ $cliente->edad }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ "Calle: ".$cliente->calle." No.". $cliente->num_exterior }} </td>
                        <td>{{ $cliente->colonia }}</td>
                        <td class="accio_cli">
                            <button class='btn btn-success edit'  data-id='{{ $cliente->id_cliente }}' data-toggle='modal' data-target='#miModal2'><i class='glyphicon glyphicon-edit'></i></button>
                            <button class='btn btn-danger' id='delete' data-id="{{ $cliente->id_cliente }}"><i class='glyphicon glyphicon-trash'></i></button>
                            

                        </td>
                    </tr>
                @else
                    <tr class="{{ $cliente->id_cliente }}" style="background-color: red;">
                        <td>{{ $cliente->id_cliente }}</td>
                        <td>{{ $cliente->nombre." ".$cliente->ape_paterno." ".$cliente->ape_materno }}</td>
                        <td>{{ $cliente->edad }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td>{{ "Calle: ".$cliente->calle." No.". $cliente->num_exterior }} </td>
                        <td>{{ $cliente->colonia }}</td>
                        <td class="accio_cli">
                            <button class='btn btn-success edit'  data-id='{{ $cliente->id_cliente }}' data-toggle='modal' data-target='#miModal2'><i class='glyphicon glyphicon-edit'></i></button>
                            <button class='btn btn-danger' id='delete' data-id="{{ $cliente->id_cliente }}"><i class='glyphicon glyphicon-ok'></i></button>
                        </td>
                    </tr>
                @endif
            @endforeach
       
        </tbody>
    </table>

    {{ $clientes->links() }}
     <strong class="pull-right" id="counts">{{ $count." Clientes" }}</strong>     
</div>