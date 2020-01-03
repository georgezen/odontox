@extends('home')

@section('content')

<section class="content-header">
    <h1>
        Editar usuario
    </h1>
</section>
<div class="content">

<div class="box box-primary">

    <div class="box-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
               @foreach($errors->all() as $error)
               <li>{{ $error }}</li>
               @endforeach
           </ul>
                
            </div>
           
        @endif
         {!! Form::open(['route' => ['usuarios.update', $users->id], 'method' => 'PUT']) !!}		
            <div class="row">
            	

                {!! csrf_field() !!}
                <div class="col-sm-6">
                    <div class="form-group ">
                        <label for="password_confirmation">Nombre de usuario</label>
                        <input type="text" class="form-control" name="name" value="{{ $users->name }}" placeholder="Nombre de usuario">
                        

                        
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="form-group ">
                        <label for="password_confirmation">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $users->email }}" placeholder="Email">

                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                 <div class="form-group">
                    <label for="password_confirmation">Contraseña</label>
                    <input type="password" class="form-control" name="password" placeholder="Contraseña">
                   

                   
                </div>

            </div>
            <div class="col-sm-6">
                <div class="form-group ">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar contraseña">
                    

                    
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                     <label for="trabajadors">Trabajador</label>
                     <select name="trabajadors" id="trabajadors" class="form-control" style="font-size: 16px;">
                         <option value="0">Seleccione un trabajador</option>
                         @foreach($trabajadors as $trabajador)
                         <option value="{{ $trabajador->id }}" {{  ($users->id_trabajador == $trabajador->id ) ? 'selected' : '' }}>{{ $trabajador->fullname }}</option>
                         @endforeach
                     </select>
                    
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                     <label for="trabajadors">Rol</label>
                     <select name="rols" id="rols" class="form-control" style="font-size: 16px;">
                         <option value="0">Seleccione un rol</option>
                         @foreach($roles as $rol)
                         <option value="{{ $rol->id }}" {{  ($users->id_rol == $rol->id ) ? 'selected' : '' }}>{{ $rol->descripcion }}</option>
                         @endforeach
                     </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                     <label for="Sucursal">Sucursal</label>
                     <select name="sucursal" id="sucursal" class="form-control" style="font-size: 16px;">
                         <option value="0">Seleccione una sucursal</option>
                         @foreach($sucursales as $sucursal)
                         <option value="{{ $sucursal->id }}" {{  ($users->id_sucursal == $sucursal->id ) ? 'selected' : '' }}>{{ $sucursal->nombre  }}</option>
                         @endforeach
                     </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">

                </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-2">
                <button type="submit" class="btn btn-primary btn-block " id="edit_user">Editar</button>
                
            </div>
            <div class="col-xs-2">
            	<a href="{!! route('usuarios.index') !!}" class="btn btn-danger btn-block">Cancel</a>
            </div>
            <!-- /.col -->
        </div>
    {!! Form::close() !!}		
</div>
</div>



</div>
@endsection
@section('scripts')
<script>
    jQuery(document).ready(function($) {
        console.log("ddd");

        $('#edit_user').click(function(event) {
            var trabajadors = $('sel    ect#trabajadors').val();
            var rols = $('select#rols').val();
            var sucursales = $('select#sucursal').val();
            if (trabajadors == 0 || rols == 0 || sucursales == 0) {
                toastr.error("Seleccione todos los datos");
                return false;
            }
        });
        


    });
</script>
@endsection



