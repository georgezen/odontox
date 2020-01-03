<div class="table-responsive">
    <table class="table table-hover table-bordered" id="roles-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Domicilio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="info_proveedores">
        @foreach($proveedores as $proveedor)
            @if($proveedor->activo == 1)
            <tr class="{{ $proveedor->id_proveedor }}" style="background-color: green;">
                <td>{{ $proveedor->id_proveedor }}</td>
                <td>{{ $proveedor->nombre." ".$proveedor->ape_paterno." ".$proveedor->ape_materno }}</td>
                <td>{{ $proveedor->telefono }}</td>
                <td>{{ "Calle: ".$proveedor->calle." | Número:".$proveedor->num_exterior." | Colonia:".$proveedor->colonia }}</td>
                <td id="acciones_prov">
                    <button class='btn btn-success edit'  data-id='{{ $proveedor->id_proveedor }}' data-toggle='modal' data-target='#miModal2'><i class='glyphicon glyphicon-edit'></i></button>
                     
                    <button class='btn btn-danger' id='delete' data-id="{{ $proveedor->id_proveedor }}"><i class='glyphicon glyphicon-trash'></i></button>
                    
                    
                    
                </td>
            </tr>
            @else
                <tr class="{{ $proveedor->id_proveedor }}" style="background-color: red;">
                <td>{{ $proveedor->id_proveedor }}</td>
                <td>{{ $proveedor->nombre." ".$proveedor->ape_paterno." ".$proveedor->ape_materno }}</td>
                <td>{{ $proveedor->telefono }}</td>
                <td>{{ "Calle: ".$proveedor->calle." | Número:".$proveedor->num_exterior." | Colonia:".$proveedor->colonia }}</td>
                <td id="acciones_prov">
                    <button class='btn btn-success edit'  data-id='{{ $proveedor->id_proveedor }}' data-toggle='modal' data-target='#miModal2'><i class='glyphicon glyphicon-edit'></i></button>
                     
                    <button class='btn btn-danger' id='delete' data-id="{{ $proveedor->id_proveedor }}"><i class='glyphicon glyphicon-ok'></i></button>
                    
                    
                    
                </td>
            </tr>
            @endif
       @endforeach
        </tbody>
    </table>
    {{ $proveedores->links() }}
</div>