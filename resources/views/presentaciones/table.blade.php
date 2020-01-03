<div class="table-responsive">
    <table class="table table-hover table-bordered" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Presentación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="info_presentaciones">
            @foreach($presentaciones as $presentacion)
  
                    <tr class='{{ $presentacion->id_presentacion }}' >
                    <td id='id_presentacion'>{{ $presentacion->id_presentacion }}</td>
                    <td id='presentacion'>{{ $presentacion->descripcion }}</td>

                    <td >
                    <button class='btn btn-success edit'  data-id='{{ $presentacion->id_presentacion }}' data-toggle='modal' data-target='#miModal2'><i class='glyphicon glyphicon-edit'></i></button>
                    </td>
                    </tr>    
                   
            @endforeach
        </tbody>
    </table>
    {{ $presentaciones->links() }}   
             <strong class="pull-right">{{ $count." Presentaciones" }}</strong>  
</div>
