@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<section class="content-header">
    <h1 class="pull-left">Nueva Compra</h1>
    

</section>




<div class="content">


    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="box-body" >
            <div class="row">
                {!! Form::open(array( 'id' => 'form_compra','method'=>'POST')) !!}
                    
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="proveedores">Proveedor:</label>
                            <select name="proveedores" id="proveedores" class="form-control select2">
                                <option value="0">Seleccione un proveedor</option>
                                @foreach($proveedores as $proveedor)
                                <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre." ".$proveedor->ape_paterno." ".$proveedor->ape_materno }}</option>
                                @endforeach
                            </select>

                        </div>



                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="folio">Folio:</label>
                            <input type="text" class="form-control" name="folio" id="folio">

                        </div>

                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="comprobante">Comprobante:</label>
                            <select name="comprobante" id="comprobante" class="form-control select2">
                                <option value="0">Seleccione un comprobante</option>
                                <option value="1">Ticket</option>
                                <option value="2">Factura</option>

                            </select>

                        </div>


                    </div>
                    <div class="col-sm-1">
                        <div class="form-group">
                             <label for="add">Añadir:</label>
                            <button class="btn btn-primary" id="add_p" name="add_p"><i class="fa fa-plus"></i></button>
                            

                        </div>

                    </div>
                </div>

                
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover table-bordered" id="detalles">
                            <thead style="background-color: #A9D0F5;">
                                <tr>
                                    <th>Acciones</th>
                                    <th>Cant.</th>
                                    <th>Descripción:</th>
                                    <th>Costo:</th>
                                    <th>Precio Venta:</th>
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
                            <tbody id="detalle_c">
                                <tr class="fila">
                                    <td>
                                       
                                    </td>
                                    <td class="cantidad">
                                       
                                        <input type="text" name="cantidad[]" class="form-control numeric cantidad_pro"  id="cantidad">
                                        
                                        
                                    </td>
                                    <td>
                                       
                                        <select name="productos[]" id="productos" class="form-control select2 productos">
                                            <option value="0">Seleccione un producto</option>
                                            @foreach($productos as $producto)
                                            <option value="{{ $producto->id_producto }}">{{ $producto->nombre." ".$producto->descripcion }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </td>
                                    <td>
                                        <input type="text" name="costo[]" class="form-control numeric costo"  id="costo">
                                    </td>
                                    <td>
                                        <input type="text" name="precio[]" class="form-control numeric precio"  id="precio">
                                    </td>
                                    <td class="subtotal">$ <strong class="subtotal_num">0.00</strong></td>
                                </tr>
                                

                            </tbody>

                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::submit('Guardar',array('class'=>'btn btn-success','id' => 'save_compra')) !!}
                        <a href=" {{ route('cancelar_compra') }}" class="btn btn-danger ">Cancelar</a>
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

      $(document).on('click','#add_p' ,function(event) {
            event.preventDefault();
           
            var fila = '<tr class="fila'+cont+'">'+
            '<td >'+
            '<button type="button" class="btn btn-danger remove" id="" data-id="'+cont+'"><i class="fa fa-remove"></i></button>'+
            '</td>'+
            '<td class="cantidad">'+
            '<input type="text" name="cantidad[]" class="form-control numeric cantidad_pro"  id="cantidad">'+
            '</td>'+
            '<td>'+
            '<select name="productos[]" id="productos" class="form-control select2 productos">'+
            '<option value="0">Seleccione un producto</option>'+
            '@foreach($productos as $producto)'+
            '<option value="{{ $producto->id_producto }}">{{ $producto->nombre." ".$producto->descripcion }}</option>'+
            '@endforeach'+
            '</select>'+
            '</td>'+
            '<td>'+
            '<input type="text" name="costo[]" class="form-control numeric costo"  id="costo">'+
            '</td>'+
            '<td>'+
            '<input type="text" name="precio[]" class="form-control numeric precio"  id="precio">'+
            '</td>'+
            '<td class="subtotal">$ <strong class="subtotal_num">0.00</strong></td>'+
            '</tr>';

            cont ++;           
            
            $('#detalles').append(fila);

    });  

    $(document).on('click','#save_compra' ,function(event) {
            event.preventDefault();
            var proveedor = $('#proveedores').val();
            var folio = $('#folio').val();
            var comprobante = $('#comprobante option:selected').html();
            var cont = 0;

          

            $('#detalles > tbody  > tr').each(function(index, val) {
                
                var canti = $(this).find('.cantidad_pro').val();
                var product = $(this).find('.productos').val();
                var costo = $(this).find('.costo').val();
                var precio = $(this).find('.precio').val();
                

                if (canti == "" || product == 0 || costo == "" || precio == "") {
                     toastr.error("Rellene los datos del producto(s)");
                    cont ++;
                }


            });
        

            if (proveedor == 0 || folio == "" || comprobante == 0 || cont != 0) {
                toastr.error("Complete todos los campos");
                    return false;
            }else{
                $.ajax({
                url: '{{ route('guardar_compra') }}',
                type: 'POST',
                dataType: 'json',
                data: {proveedores:proveedor,
                       folio: folio,
                       comprobante:comprobante  },
                })
                .done(function(data) {
                  insert_detalle(data.data);
                });

            }

            
            


            
    });  


    function insert_detalle(data) {
        console.log(data);

        
        var data_array = [];
        var data_object =[];

            $('#detalles > tbody  > tr').each(function(index, val) {
                
                var canti = $(this).find('.cantidad_pro').val();
                var product = $(this).find('.productos').val();
                var costo = $(this).find('.costo').val();
                var precio = $(this).find('.precio').val();
                

                if (canti == "" || product == 0 || costo == "" || precio == "") {
                     toastr.error("Rellene los datos del producto(s)");
                    return false;
                }
                data_object = [data,
                               canti,
                               product,
                               costo,
                               precio];
                data_array.push(data_object);


            });
            console.log(data_array);

            
                $.ajax({
                url: '{{ route('insert_detalle_compra') }}',
                type: 'post',
                data: {detalles: data_array},
                dataType: 'json',
                })
                .done(function(data) {
                    window.location.href = '{{ route('compras') }}';
                });

            

            
      }  
     
     

    $('tbody').on('keyup','.costo,.cantidad_pro', function(event) {
        event.preventDefault();
        var tr = $(this).parent().parent();
        var costo = tr.find('.costo').val();
        var cantidad_pro = tr.find('.cantidad_pro').val();
        var sub_preciso = 0;
        
        subtotal = (cantidad_pro * costo);
        sub_preciso = subtotal.toFixed(2);
        tr.find('.subtotal_num').html(sub_preciso);
        totales();

        

    });


    function totales(){
        var total = 0;
        $('.subtotal_num').each(function(index, el) {
             var subtotal = $(this).html()-0;
             var total_preciso = 0;
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


    


});
</script>
@endsection


