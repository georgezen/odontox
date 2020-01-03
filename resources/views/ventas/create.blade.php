@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<section class="content-header">
    <h1 class="pull-left">Nueva Venta</h1>
    

</section>

<div class="content">


    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body" >
            <div class="row">
                {!! Form::open(array( 'id' => 'form_venta','method'=>'POST')) !!}
                    
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="proveedores">Clientes:</label>
                            <select name="proveedores" id="proveedores_venta" class="form-control select2">
                                <option value="0">Seleccione un cliente</option>
                                @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id_cliente }}">{{ $cliente->full_na }}</option>
                                @endforeach
                            </select>

                        </div>

                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="folio">Folio:</label>
                            <input type="text" class="form-control" name="folio_venta" id="folio_venta">

                        </div>

                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="comprobante">Comprobante:</label>
                            <select name="comprobante_venta" id="comprobante_venta" class="form-control select2">
                                <option value="0">Seleccione un comprobante</option>
                                <option value="1">Ticket</option>
                                <option value="2">Factura</option>

                            </select>

                        </div>


                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                             <label for="add">Añadir:</label>
                            <button class="btn btn-primary" id="add_p_venta" name="add_p_venta"><i class="fa fa-plus"></i></button>
                            

                        </div>

                    </div>
                </div>

                
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover table-bordered" id="detalles_vent">
                            <thead style="background-color: #A9D0F5;">
                                <tr>
                                    <th>Acciones</th>
                                    <th>Cant.</th>
                                    <th>Descripción:</th>
                                    <th>Precio Venta:</th>
                                    <th>Descuento:</th>
                                    <th>Subtotal:</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>$ <strong id="total">0.00</strong></th>
                                </tr>
                            </tfoot>
                            <tbody id="detalle_venta">
                                <tr class="fila">
                                    <td>
                                         
                                       
                                    </td>
                                    <td class="cantidad">
                                       
                                        <input type="text" name="cantidad[]" class="form-control numeric cantidad_venta stock_actual"  id="cantidad_venta">
                                        
                                    </td>
                                    <td>
                                       
                                        <select name="productos[]" id="productos_venta" class="form-control select2 productos_venta">
                                            <option value="0">Seleccione un producto</option>
                                            @foreach($productos as $producto)
                                            <option value="{{ $producto->id_producto }}">{{ $producto->producto }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </td>
                                    <td>
                                        <input type="text" name="precio[]" class="form-control numeric precio_venta"  id="precio_venta">
                                        
                                    </td>
                                    <td>

                                        <select name="descuento" id="descuento" class="form-control descuento">
                                            <option value="0">Seleccione un descuento</option>
                                            <option value="10">10 %</option>
                                            <option value="20">20 %</option>
                                            <option value="30">30 %</option>
                                        </select>
                                    </td>
                                    <td class="subtotal">$ <strong class="subtotal_venta">0.00</strong></td>
                                </tr>
                                

                            </tbody>

                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::submit('Guardar',array('class'=>'btn btn-success','id' => 'save_venta')) !!}
                        <a href=" {{ route('ventas') }}" class="btn btn-danger ">Cancelar</a>
                    </div>
                </div> 
            {!! Form::hidden('_token',csrf_token()) !!}
            {!! Form::close() !!}
            
        </div>
    </div>
    <div class="text-center">

    </div>
</div>

@endsection

@section('scripts')
<script>


    jQuery(document).ready(function($) {
      console.log("hola");
      $.ajaxSetup({
        beforeSend: function(xhr, type) {
            if (!type.crossDomain) {
                xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            }
        },
    });

      

      $('.select2').select2({

      });
       var cont = 0;
      
      var subtotal = 0;
      
      

      $(document).on('click','#add_p_venta' ,function(event) {
            event.preventDefault();
           
            var fila = '<tr class="fila'+cont+'">'+
            '<td >'+
            
            '<button type="button" class="btn btn-danger remove" id="" data-id="'+cont+'"><i class="fa fa-remove"></i></button>'+
            '</td>'+
            '<td class="cantidad">'+
            '<input type="text" name="cantidad[]" class="form-control numeric cantidad_venta stock_actual"  id="cantidad_venta">'+
            '</td>'+
            '<td>'+
            '<select name="productos[]" id="productos_venta" class="form-control select2 productos_venta">'+
            '<option value="0">Seleccione un producto</option>'+
            '@foreach($productos as $producto)'+
            '<option value="{{ $producto->id_producto }}">{{ $producto->producto }}</option>'+
            '@endforeach'+
            '</select>'+
            '</td>'+
            '<td>'+
             '<input type="text" name="precio[]" class="form-control numeric precio_venta"  id="precio_venta">'+
            '</td>'+
            '<td>'+
            '<select name="descuento" id="descuento" class="form-control descuento">'+
                                            '<option value="0">Seleccione un descuento</option>'+
                                            '<option value="10">10 %</option>'+
                                            '<option value="20">20 %</option>'+
                                            '<option value="30">30 %</option>'+
                                        '</select>'+
            '</td>'+
            '<td class="subtotal">$ <strong class="subtotal_venta">0.00</strong></td>'+
            '</tr>';

            cont ++;           
            
            $('#detalle_venta').append(fila);

    });  
     
      //funcion para calcular los subtotales por cada  producto 
    

    

    //funcion para calcular el descuento 
     $('tbody').on('change','.descuento', function(event) {
        var tr = $(this).parent().parent();
        var precio_venta1 = tr.find('.precio_venta').val();
        var cantidad_venta1 = tr.find('.cantidad_venta').val();
        var descuento = tr.find('.descuento').val();
        var sub_preciso = 0;

        if (descuento == 10) {
            subtotal = (precio_venta1 * cantidad_venta1)*0.9;
        }else if (descuento == 20) {
            subtotal = (precio_venta1 * cantidad_venta1)*0.8;
        }else if (descuento == 0) {
            subtotal = (precio_venta1 * cantidad_venta1)*1;
        }else{
            subtotal = (precio_venta1 * cantidad_venta1)*0.7;
        }
        sub_preciso = subtotal.toFixed(2);
        console.log(sub_preciso);
        tr.find('.subtotal_venta').html(sub_preciso);
        totales();
        

     });


     //funcion de asignacion de precio_promedio y stock actual del producto elegido
    $('tbody').on('change','.productos_venta', function(event) {
        var tr = $(this).parent().parent();
        var producto = tr.find('.productos_venta').val();
        var subtotal = 0;

        

        $.ajax({
            url: '{{ route('get_info_producto') }}',
            type: 'GET',
            dataType: 'json',
            data: {get_producto: producto},
        })
        .done(function(data) {
            console.log($.isEmptyObject(data));
            
           
           if ($.isEmptyObject(data) == true) {
                toastr.error("No hay compra de este producto");
           }else{

                //Se deposita los valores de la consulta
                tr.find('.cantidad_venta').val(data[0].stock);
                tr.find('.precio_venta').val(data[0].precio_promedio);
                //Se calcula el total con los datos de la consulta y se corta a 2 decimales
                subtotal = (data[0].stock * data[0].precio_promedio);
                subtotal = subtotal.toFixed(2);
                tr.find('.subtotal_venta').html(subtotal);
                totales();
                
                
           }

          
        });
        

    });

    $('tbody').on('keyup','.precio_venta,.cantidad_venta,.stock_hidden', function(event) {
        event.preventDefault();
        var tr = $(this).parent().parent();
        var precio_venta = tr.find('.precio_venta').val();
        var cantidad_venta = tr.find('.cantidad_venta').val();
        
        var sub_preciso = 0;

        $('#save_venta').prop('disabled', false) ;
        subtotal = (precio_venta * cantidad_venta);
        sub_preciso = subtotal.toFixed(2);
        tr.find('.subtotal_venta').html(sub_preciso);
        totales();

        
        
        
    });




    function totales(){
        var total_preciso = 0;
        var total = 0;
        $('.subtotal_venta').each(function(index, el) {
             var subtotal = $(this).html()-0;
             total = total + subtotal;
             total_preciso = total.toFixed(2);
             $('#total').html(total_preciso);
             console.log(total_preciso);
       });

    }



    //$(document).on('click', selector, function(event) esta forma de declarar eventos funiona para //elementos creados por js o por html
    $(document).on('click','.remove', function(event) {
        event.preventDefault();
        
        var index = $(this).data('id');
        console.log(index);
       
        $('.fila' + index).remove();
        totales();
    });



    $(document).on('click','#save_venta' ,function(event) {
            event.preventDefault();
            var proveedor_venta = $('#proveedores_venta').val();
            var folio_venta = $('#folio_venta').val();
            var comprobante_venta = $('#comprobante_venta option:selected').html();
            var total = $('#total').html();
            var cont = 0;

            $('#detalles_vent > tbody  > tr').each(function(index, val) {
                
                var canti = $(this).find('.cantidad_venta').val();
                var product = $(this).find('.productos_venta').val();
                var precio = $(this).find('.precio_venta').val();
               
                
                

                if (canti == "" || product == 0 || precio == "" ) {
                     toastr.error("Rellene los datos del producto(s) ");
                    cont ++;

              }
            });

           
        

            if (proveedor_venta == 0 || folio_venta == "" || comprobante_venta == "Seleccione un comprobante" || cont != 0) {
                toastr.error("Complete todos los campos");
                    return false;
            }else{
                $.ajax({
                url: '{{ route('guardar_venta') }}',
                type: 'POST',
                dataType: 'json',
                data: {cliente:proveedor_venta,
                       folio: folio_venta,
                       comprobante:comprobante_venta,
                       total:total  },
                })
                .done(function(data) {
                    console.log(data);
                  insert_detalle(data.data);
                });

            }

    });  


    function insert_detalle(data) {
        console.log(data);

        
        var data_array = [];
        var data_object =[];

            $('#detalles_vent > tbody  > tr').each(function(index, val) {
                
                var canti = $(this).find('.cantidad_venta').val();
                var product = $(this).find('.productos_venta').val();
                var precio = $(this).find('.precio_venta').val();
                var descuento = $(this).find('.descuento').val();
                

               
                data_object = [data,
                               product,
                               canti,
                               precio,
                               descuento];
                data_array.push(data_object);


            });
            console.log(data_array);

            
                $.ajax({
                url: '{{ route('insert_detalle_venta') }}',
                type: 'post',
                data: {detalles: data_array},
                dataType: 'json',
                })
                .done(function(data) {
                    console.log(data);
                    window.location.href = '{{ route('ventas') }}';
                });
            
      }  

});
</script>
@endsection


