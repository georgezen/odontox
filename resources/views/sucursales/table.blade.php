<div class="table-responsive">
    <table class="table" id="sucursales-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($sucursales as $sucursales)
        @if($sucursales->activo == 1)
            <tr class="{{ $sucursales->id }}" style="background-color: green;">
                <td id="sucursal_id">{!! $sucursales->id !!}</td>
                <td id="sucursal_nom">{!! $sucursales->nombre !!}</td>
                <td id="suc_acciones">
                        <a  class='btn btn-success  edit' data-id="{{ $sucursales->id }}" data-toggle='modal' data-target='#miModal2'><i class="glyphicon glyphicon-edit"></i></a>
                         <button class='btn btn-danger' id='delete' data-id="{{ $sucursales->id }}"><i class='glyphicon glyphicon-trash'></i></button>
                </td>
            </tr>
        @else
            <tr class="{{ $sucursales->id }}" style="background-color: red;">
                <td id="sucursal_id">{!! $sucursales->id !!}</td>
                <td id="sucursal_nom">{!! $sucursales->nombre !!}</td>
                <td id="suc_acciones">
                        <a  class='btn btn-success edit' data-id="{{ $sucursales->id }}" data-toggle='modal' data-target='#miModal2'><i class="glyphicon glyphicon-edit"></i></a>
                         <button class='btn btn-danger' id='delete' data-id="{{ $sucursales->id }}"><i class='glyphicon glyphicon-trash'></i></button>
                </td>
            </tr>

        @endif    
        @endforeach
        </tbody>
    </table>
</div>
