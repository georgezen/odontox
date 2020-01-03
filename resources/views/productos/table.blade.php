<div class="table-responsive">

    <table class="table table-hover table-bordered" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
               
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="info_productos">
            @foreach($productos as $producto)
           @if($producto->estado == 1)
            <tr class='{{ $producto->id_producto }}' style="background-color: green">
                    <td id='id_pro'>{{ $producto->id_producto }}</td>
                    <td id='codigo_pro'>{{ $producto->codigo }}</td>
                    <td id='nombre_pro'>{{ $producto->nombre }}</td>
                    <td id='descripcion_pro'>{{ $producto->descripcion }}</td>
                   
                    <td id='imagen_pro'> 
                        @if($producto->imagen != null)
                        <img style="width:100px; height:100px;" class="pull-left"src="{{ asset('imagenes/'.$producto->imagen) }}">
                        
                        @else
                        <button type="button" id="cargar_id" class="btn btn-primary pull-left" data-toggle="modal" data-target="#load_image" data-id='{{ $producto->id_producto }}'><i class='glyphicon glyphicon-open'></i></button>
                        @endif
                       
                    </td>
                    <td id='acciones_pro'>
                        
                    <button class='btn btn-success edit'  data-id='{{ $producto->id_producto }}' data-toggle='modal' data-target='#miModal2'><i class='glyphicon glyphicon-edit'></i></button>
                     @if($producto->estado == 1)
                    <button class='btn btn-danger' id='delete' data-id="{{ $producto->id_producto }}"><i class='glyphicon glyphicon-trash'></i></button>
                    @else
                    <button class='btn btn-danger' id='delete' data-id="{{ $producto->id_producto }}"><i class='glyphicon glyphicon-ok'></i></button>
                    @endif
                    </td>
                    </tr>
              @else  
                           <tr class='{{ $producto->id_producto }}' style="background-color: red">
                    <td id='id_pro'>{{ $producto->id_producto }}</td>
                    <td id='codigo_pro'>{{ $producto->codigo }}</td>
                    <td id='nombre_pro'>{{ $producto->nombre }}</td>
                    <td id='descripcion_pro'>{{ $producto->descripcion }}</td>
                    
                    <td id='imagen_pro'> 
                        @if($producto->imagen != null)
                        <img style="width:100px; height:100px;" class="pull-left"src="{{ asset('imagenes/'.$producto->imagen) }}">
                        
                        @else
                        <button type="button" id="cargar_id" class="btn btn-primary pull-left" data-toggle="modal" data-target="#load_image" data-id='{{ $producto->id_producto }}'><i class='glyphicon glyphicon-open'></i></button>
                        @endif
                       
                    </td>
                    <td id='acciones_pro'>
                        
                    <button class='btn btn-success edit'  data-id='{{ $producto->id_producto }}' data-toggle='modal' data-target='#miModal2'><i class='glyphicon glyphicon-edit'></i></button>
                     @if($producto->estado == 1)
                    <button class='btn btn-danger' id='delete' data-id="{{ $producto->id_producto }}"><i class='glyphicon glyphicon-trash'></i></button>
                    @else
                    <button class='btn btn-danger' id='delete' data-id="{{ $producto->id_producto }}"><i class='glyphicon glyphicon-ok'></i></button>
                    @endif
                    </td>
                    </tr>    
             @endif       
            @endforeach

            
       
        </tbody>
    </table>
  
                
            {{ $productos->render() }}   
             <strong class="pull-right" id="counts">{{ $count." Productos" }}</strong>     
            
            
    

</div>
