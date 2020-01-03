<div class="table-responsive">
    <table class="table" id="tipoMarcadors-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descripcion</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tipoMarcadors as $tipoMarcador)
            <tr>
                <td>{!! $tipoMarcador->id !!}</td>
                <td>{!! $tipoMarcador->descripcion !!}</td>
                <td>
                    {!! Form::open(['route' => ['tipoMarcadors.destroy', $tipoMarcador->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('tipoMarcadors.show', [$tipoMarcador->id]) !!}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('tipoMarcadors.edit', [$tipoMarcador->id]) !!}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
