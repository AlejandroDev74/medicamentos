@extends('adminlte::page')

@section('title', 'Medicamentos')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap4.css">
@endsection

@section('content')

<?php
    session_start();
?>
<div class="container">
    <div class="row justify-content-center">

    <div class="col-md-6">
        <br>
            <div class="card">
                <div class="card-header text-white bg-dark mb-3">{{ __('Registro de medicamento') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
    <form action="registrar_medicamento" method="post">
    @csrf
    
    <table>
        <tr><td>
            <div class="input-group mb-3">
                Nombre del producto: 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-box"></i></span>
                </div>
                <input type="text" class="form-control" name="producto" autofocus required>
            </div>
            </div>
        </td>
        <td>
            <div class="input-group mb-3">
                Registro INVIMA: 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-book"></i></span>
                </div>
                <input type="text" class="form-control" name="registro" required>
            </div>
            </div>
        </td></tr>

        <tr><td>
            <div class="input-group mb-3">
                Fecha de expedición: 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="date" class="form-control" name="expedicion" required>
            </div>
            </div>
        </td>
        <td>
            <div class="input-group mb-3">
                Fecha de vencimiento: 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="date" class="form-control" name="vencimiento" required>
            </div>
            </div>
        </td></tr>

        <tr><td>
            <div class="input-group mb-3">
                Cantidad: 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                </div>
                <input type="number" class="form-control" name="cantidad" required>
            </div>
            </div>
        </td>
        <td>
            <div class="input-group mb-3">
                Unidad de medida: 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-bars"></i></span>
                </div>
                <select name="unidad" class="input-group-text">
                    <option value="0" disabled selected>Seleccione una opción</option>
                    <option value="Unidad">Unidad</option>
                    <option value="Miligramos">Miligramos</option>
                    <option value="Mililitros">Mililitros</option>
                </select>
            </div>
            </div>
        </td></tr>

        <tr><td colspan=2>
            <div class="input-group mb-3">
                Proveedor del producto: 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-users"></i></span>
             
                    <select name="proveedor" class="input-group-text">
                    <option value="0" disabled selected>Seleccione una opción</option>
                    @foreach($data1 as $d1)
                        <option value="{{ $d1->pro_id }}">{{ $d1->pro_nombre }}</option>
                    @endforeach
                </select>
                </div>
            </div>
            </div>
        </td></tr>

        <tr><td colspan=2>
            <div class="input-group mb-3">
                Descripción del producto: 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-comment"></i></span>
             
                <textarea name="descripcion" rows="2" cols="50"></textarea>
                </div>
            </div>
            </div>
        </td></tr>

        <tr><td colspan=2>
            <div class="input-group mb-3">
                Componentes del producto: 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-flask"></i></span>
             
                <textarea name="componentes" rows="3" cols="50"></textarea>
                </div>
            </div>
            </div>
        </td></tr>
    </table>

    </div>

    <div class="card-footer">
    <button type="submit" class="btn btn-primary float-right">
        <span class="fas fa-plus"></span> Registrar</button>
    </div>

    </form>
                         
            </div>
        </div>
    </div>


    <!-- MODAL EDICIÓN DE medicamento -->
    <form action="actualizar_medicamento" method="post">
    @csrf

    <div class="modal fade" id="edicion" tabindex="-1" role="dialog" aria-labelledby="estadoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header bg-dark">
            <h5 class="modal-title" id="estadoLabel">Edición de medicamento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <table>
            <tr><td colspan=2>
                Id: 
            <input type="text" class="form-control" id="id" name="id" required readonly>
            </td></tr>
        <tr><td>
            <div class="input-group mb-3">
                Nombre del producto: 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-box"></i></span>
                </div>
                <input type="text" class="form-control" id="producto" name="producto" autofocus required>
            </div>
            </div>
        </td>
        <td>
            <div class="input-group mb-3">
                Registro INVIMA: 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-book"></i></span>
                </div>
                <input type="text" class="form-control" id="registro" name="registro" required>
            </div>
            </div>
        </td></tr>

        <tr><td>
            <div class="input-group mb-3">
                Fecha de expedición: 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="date" class="form-control" id="fecha_expedicion" name="fecha_expedicion" required>
            </div>
            </div>
        </td>
        <td>
            <div class="input-group mb-3">
                Fecha de vencimiento: 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required>
            </div>
            </div>
        </td></tr>

        <tr><td>
            <div class="input-group mb-3">
                Cantidad: 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-list"></i></span>
                </div>
                <input type="number" class="form-control" id="cantidad" name="cantidad" required>
            </div>
            </div>
        </td>
        <td></tr>

        <tr><td colspan=2>
            <div class="input-group mb-3">
                Descripción del producto: 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-comment"></i></span>
             
                <textarea id="descripcion" name="descripcion" rows="2" cols="50"></textarea>
                </div>
            </div>
            </div>
        </td></tr>

        <tr><td colspan=2>
            <div class="input-group mb-3">
                Componentes del producto: 
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-flask"></i></span>
             
                <textarea id="componentes" name="componentes" rows="3" cols="50"></textarea>
                </div>
            </div>
            </div>
        </td></tr>
    </table>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">
            <span class="fas fa-recycle"></span>
                {{ 'Actualizar' }}
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
        </div>
    </div>
    </div>
    </form>

    <!-- MODAL HABILITACIÓN DE PRODUCTOS -->
    <form action="habilitacion_medicamento" method="post">
    @csrf

    <div class="modal fade" id="habilitacion" tabindex="-1" role="dialog" aria-labelledby="estadoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="estadoLabel">Estado del medicamento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
       
        <div class="input-group mb-3">
                Id: 
                <div class="input-group">        
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="text" class="form-control" id="id2" name="id2" required readonly>
                </div>
                </div>

            <div class="input-group mb-3">
                Nombre medicamento: 
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="nombre2" name="nombre2" placeholder="Nombre completo" autofocus required>
                </div>
                </div>

                <div class="input-group mb-3">
                    Estado medicamento: 
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-eye"></i></span>
                    </div>
                    <input type="text" class="form-control" id="estado2" name="estado2" placeholder="Estado del medicamento" required>
                </div>
                </div>
            </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary bg-green">
            <span class="fas fa-thumbs-up"></span>
                {{ 'Habilitar' }}
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
        </div>
    </div>
    </div>
    </form>

    <!-- MODAL INHABILITACIÓN DE medicamento -->
    <form action="inhabilitacion_medicamento" method="post">
    @csrf

    <div class="modal fade" id="inhabilitacion" tabindex="-1" role="dialog" aria-labelledby="estadoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="estadoLabel">Estado del medicamento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
       
        <div class="input-group mb-3">
            Id: 
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="id3" name="id3" required readonly>
                </div>
                </div>

            <div class="input-group mb-3">
                Nombre medicamento: 
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="nombre3" name="nombre3" placeholder="Nombre completo" autofocus required>
                </div>
                </div>

                <div class="input-group mb-3">
                    Estado medicamento: 
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-eye"></i></span>
                    </div>
                    <input type="text" class="form-control" id="estado3" name="estado3" placeholder="Estado del medicamento" required>
                </div>
                </div>
            </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary bg-red">
            <span class="fas fa-thumbs-down"></span>
                {{ 'Inhabilitar' }}
            </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
        </div>
    </div>
    </div>
    </form>

    <div class="col-md-12">
        <br>
            <div class="card">
                <div class="card-header text-white bg-dark mb-3">{{ __('Listado de medicamentos registrados') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

        @csrf

        <table class="table table-striped table-hover" id="medicamentos" style='text-align: center; vertical-align: middle;'>
            <thead align="center">
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Unidad</th>
                <th scope="col">Fecha_vencimiento</th>
                <th scope="col" colspan='2'>Acciones</th>
                <th scope="col">Última mod</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data as $d)
                <tr>
                    <td>{{ $d->med_id }}</td>
                    <td>{{ $d->med_producto }}</td>
                    <td>{{ $d->med_cantidad }}</td>
                    <td>{{ $d->med_unidad }}</td>
                    <td>{{ $d->med_fecha_vencimiento }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edicion" title="Editar" id="editar"
                        data-id="{{ $d->med_id }}" data-producto="{{ $d->med_producto }}" data-registro="{{ $d->med_registro_sanitario }}" data-fecha_expedicion="{{ $d->med_fecha_expedicion }}" data-fecha_vencimiento="{{ $d->med_fecha_vencimiento }}" data-cantidad="{{ $d->med_cantidad }}" data-descripcion="{{ $d->med_descripcion }}" data-componentes="{{ $d->med_componentes }}">
                            <span class="fas fa-edit"></span>
                        </button>
                    </td>
                    @if ($d->med_estado === 1)
                    <td>
                        <button type="button" class="btn btn-primary bg-red" data-toggle="modal" data-target="#inhabilitacion" title="Inhabilitar" id="inhabilitar"
                        data-id3="{{ $d->med_id }}" data-nombre3="{{ $d->med_producto }}" data-estado3="El medicamento se encuentra habilitado">
                            <span class="fas fa-thumbs-down"></span>
                        </button>
                    </td>
                    @else
                    <td>
                        <button type="button" class="btn btn-primary bg-green" data-toggle="modal" data-target="#habilitacion" title="Habilitar" id="habilitar"
                        data-id2="{{ $d->med_id }}" data-nombre2="{{ $d->med_producto }}" data-estado2="El medicamento se encuentra inhabilitado">
                            <span class="fas fa-thumbs-up"></span>
                        </button>
                    </td>
                    @endif
                   
                    <td >{{ $d->med_fecha_registro }}</td>
                </tr>
            @endforeach
             </tbody>
           
        </table>
                    
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')

    <script>

        $('#medicamentos').DataTable({
            responsive: true,
            autoWidth: false,

        "language": {   
            "lengthMenu": "Mostrar _MENU_ registros de página",
            "zeroRecords": "No se han encontrado registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No se han encontrado registros",
            "infoFiltered": "(Filtrando de _MAX_ total de registros)",
            "search": "Busqueda: ",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
        });

        $(document).on("click", "#editar", function() {
            var id = $(this).data('id');
            var producto = $(this).data('producto');
            var registro = $(this).data('registro');
            var fecha_expedicion = $(this).data('fecha_expedicion');
            var fecha_vencimiento = $(this).data('fecha_vencimiento');
            var cantidad = $(this).data('cantidad');
            var descripcion = $(this).data('descripcion');
            var componentes = $(this).data('componentes');

            $("#id").val(id);
            $("#producto").val(producto);
            $("#registro").val(registro);
            $("#fecha_expedicion").val(fecha_expedicion);
            $("#fecha_vencimiento").val(fecha_vencimiento);
            $("#cantidad").val(cantidad);
            $("#descripcion").val(descripcion);
            $("#componentes").val(componentes);
        });

        $(document).on("click", "#habilitar", function() {
            var id2 = $(this).data('id2');
            var nombre2 = $(this).data('nombre2');
            var estado2 = $(this).data('estado2');

            $("#id2").val(id2);
            $("#nombre2").val(nombre2);
            $("#estado2").val(estado2);
        });

        $(document).on("click", "#inhabilitar", function() {
            var id3 = $(this).data('id3');
            var nombre3 = $(this).data('nombre3');
            var estado3 = $(this).data('estado3');

            $("#id3").val(id3);
            $("#nombre3").val(nombre3);
            $("#estado3").val(estado3);
        });

    var mensaje = <?php echo $_SESSION["mensaje"]; ?>;
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
        });

        switch (mensaje) {
            case 1:
                Toast.fire({
                text: " Registro exitoso!",
                type: "success",
                });
            break;

            case 2:
                Toast.fire({
                text: " Actualización exitosa!",
                type: "success",
                });
            break;

            case 3:
                Toast.fire({
                text: " Ha ocurrido un problema!",
                type: "error",
                });
            break;
        }
        <?php   $_SESSION["mensaje"] = 0;   ?>

    </script>
@endsection