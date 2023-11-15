<?php echo $this->extend('Admin/layout/principal') ?>

<?= $this->section('titulo') ?>

<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php echo $titulo; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $titulo; ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="swal" data-swal="<?= session()->get('registrado') ?>"></div>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="card-body">
        <div class="box-header with-border">
            <a href="<?php echo base_url(); ?>/panel/especialidades/nuevo" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Ingresar Especialidad </a>
            <a href="<?php echo base_url(); ?>panel/especialidades/" class="btn btn-info"><i class="fas fa-list-ol"></i> Listar Especialidades
            </a>
            <div class="box-tools pull-right">
                <br>
            </div>
        </div>
        <?php
        echo session()->getFlashdata('info');
        ?>

        <div class="margin-top">
            <table id="tablaEspecialidad" class="table table-bordered table-striped" style="font-size: 13px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Especialidad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                

                <tbody>

                    <?php foreach ($especialidades as $especialidad) : ?>
                        <tr>
                            <td><?php echo $especialidad['idEspecialidad']; ?></td>
                            <td><?php echo $especialidad['descripcion']; ?></td>
                            <td><?php
                             echo ($especialidad['sitReg']==1) ? 'Activo' : 'Inactivo';
                              ?></td>
                             <td>
                               
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">Acción</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="<?= base_url('Especialidad/edit/' . $especialidad['idEspecialidad']) ?>">Ver</a>
                                        <a class="dropdown-item" href="#">Editar</a>
                                        <a class="dropdown-item" href="<?= base_url('panel/especialidades/activar' . $especialidad['idEspecialidad']) ?>">Activar</a>
                                        
                                    </div>
                                </div>

                            </td>

                        </tr>
                    <?php endforeach; ?>

                <tfoot>
                    <tr>
                    <tr>
                    <th>ID</th>
                        <th>Especialidad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <?= $this->endSection() ?>

        <?= $this->section('scripts') ?>
        <script>
            var table = $('#tablaEspecialidad').DataTable({
                "dom": 'Bfrtip',
                "buttons": [
                    'pageLength',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                "lengthMenu": [
                    [10, 25, 50, -1],
                    ['10 Resultados', '25 Resultados', '50 Resultados', 'Motrar Todos']
                ],
                "buttons": {
                    "pageLength": {
                        _: "Mostrar %d Registros"
                    }
                },
                "language": {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Registros",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        </script>

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
        <?= $this->endSection() ?>