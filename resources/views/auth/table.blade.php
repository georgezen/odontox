<div class="table-responsive">
    <table class="table" id="trabajadores-table">
        <thead>
            <tr>
                <th>ID</th>
                <th >Nombre</th>
                <th >Email</th>
                <th >Sucursal</th>
                <th >Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            
            <tr class="<?php
                        if ($user->activo == 0) {
              echo "danger";
                            }
                    ?>">
                <td>{!! $user->id !!}</td>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->email !!}</td>
               
                 <td>{!! $user->nombre !!}</td>

                

                <td>
                    @if($user->activo == 1)
                        {!! Form::open(['route' => ['usuarios.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        
                        <a href="{!! route('usuarios.edit', [$user->id]) !!}" class='btn btn-success btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Desea desactivar el usuario?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => ['usuarios.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        
                        <a href="{!! route('usuarios.edit', [$user->id]) !!}" class='btn btn-success btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-ok"></i>', ['type' => 'submit', 'class' => 'btn btn-success btn-sm', 'onclick' => "return confirm('Desea reactivar el usuario?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
