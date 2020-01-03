<div class="table-responsive">
    <table class="table" id="jornadas-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hora Inicio</th>
        <th>Hora Fin</th>
        <th>Descripcion</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($jornadas as $jornadas)
            <tr>
                 <td>{!! $jornadas->id !!}</td>
                <td>{!! $jornadas->hora_inicio !!}</td>
            <td>{!! $jornadas->hora_fin !!}</td>
            <td>{!! $jornadas->descripcion !!}</td>
                <td>
                    {!! Form::open(['route' => ['jornadas.destroy', $jornadas->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('jornadas.show', [$jornadas->id]) !!}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('jornadas.edit', [$jornadas->id]) !!}" class='btn btn-default btn-sm'><i class="fa fa-pencil"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
