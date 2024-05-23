@extends('adminlte::page')

@section('title', 'Catálogos')

@section('content')

<?php
    session_start();
?>
<div class="container">
    <div class="row justify-content-center">

    <div class="col-md-12">
        <br>
            <div class="card">
                <div class="card-header text-white bg-dark mb-3">{{ __('Búsqueda de medicamentos') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

        @csrf

        <table class="table table-striped table-hover" id="catalogo" style='text-align: center; vertical-align: middle;'>
            <thead align="center">
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Unidad</th>
                <th scope="col">Fecha vencimiento</th>
                <th scope="col">Componentes</th>
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
                    <td>{{ $d->med_componentes }}</td>
                    <td>
                        <button type="button" class="btn btn-primary bg-green" data-toggle="modal" data-target="#edicion" title="Comprar" id="comprar">
                            <span class="fas fa-dollar-sign"></span>
                        </button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edicion" title="Detalles" id="detalles">
                            <span class="fas fa-eye"></span>
                        </button>
                    </td>
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

        $('#catalogo').DataTable({
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

            case 4:
                Toast.fire({
                text: " Inicio de sesión exitoso!",
                type: "success",
                });
            break;
        }
        <?php   $_SESSION["mensaje"] = 0;   ?>

    </script>
@endsection