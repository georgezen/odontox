<div class="table-responsive">
    <table class="table table-hover table-bordered" >
        <thead>
            <tr>
                <th>ID</th>
                <th colspan="3">Nombre</th>
                <th colspan="4">Fecha Nac</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody id="info_trab">
            @foreach($trabajadores as $trabajador)
            @if ($trabajador->activo == 1)
                <tr class="{!! $trabajador->id !!}" style="background-color: green;">
                <td id="trabajador_id">{!! $trabajador->id !!}</td>
                <td id="full_name_trab" colspan="3">{!! $trabajador->nombre." ".$trabajador->apellido_pat." ".$trabajador->apellido_mat !!}</td>
                <td id="fech_trab" colspan="4">{{ $newDate = date("d/m/Y", strtotime($trabajador->fecha_nac)) }}
                    
                    
                <td id="acciones_trab">
                     <a  class='btn btn-success edit' data-id="{{ $trabajador->id}}" data-toggle='modal' data-target='#miModal2'><i class="glyphicon glyphicon-edit"></i></a>
                     <button class='btn btn-danger' id='delete' data-id="{{ $trabajador->id }}"><i class='glyphicon glyphicon-trash'></i></button>
                 </td>
            </tr>
            @else
                <tr class="{!! $trabajador->id !!}" style="background-color: red;">
                <td id="trabajador_id">{!! $trabajador->id !!}</td>
                <td id="full_name_trab" colspan="3">{!! $trabajador->nombre." ".$trabajador->apellido_pat." ".$trabajador->apellido_mat !!}</td>
                <td id="fech_trab" colspan="4">{!! $newDate = date("d/m/Y", strtotime($trabajador->fecha_nac))  !!}</td>
                <td id="acciones_trab">
                     <a  class='btn btn-success edit' data-id="{{ $trabajador->id}}" data-toggle='modal' data-target='#miModal2'><i class="glyphicon glyphicon-edit"></i></a>
                     <button class='btn btn-danger' id='delete' data-id="{{ $trabajador->id }}"><i class='glyphicon glyphicon-ok'></i></button>
                 </td>
            </tr>    
            @endif
            
    @endforeach
</tbody>
</table>
{{ $trabajadores->links() }}
 <strong class="pull-right">{{ $count." Trabajadores" }}</strong>  

 

</div>
