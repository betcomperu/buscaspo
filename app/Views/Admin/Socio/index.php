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
            <a href="<?php echo base_url(); ?>panel/nuevo" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Ingresar Socio </a>
            <a href="<?php echo base_url(); ?>/panel/eliminados" class="btn btn-warning"><i class="fas fa-list-ol"></i> Eliminados
            </a>
            <div class="box-tools pull-right">
                <br>
            </div>
        </div>
        <?php
        echo session()->getFlashdata('info');
        ?>

        <div class="margin-top">
            <table id="tablaSocios" class="table table-bordered table-striped" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Foto</th>
                        <th>DNI</th>
                        <th>CMP</th>
                        <th>Nombre</th>
                        <th>Ap.Paterno</th>
                        <th>Ap.Materno</th>
                        <th>Teléfono</th>
                        <th>Fec.Nac</th>
                        <th>Domicilio</th>
                        <th>Email</th>
                        <th>RNE</th>
                        <th>Tipo Socio</th>
                        <th>Sede</th>
                        <th>Especialidad</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($socios as $dato) : ?>
                        <tr>
                            <td><?php echo $dato['idSocio']; ?></td>
                            <td>
                                <img src="<?= base_url('uploads/') . $dato['foto']; ?>" alt="img-responsive" width="80">

                            </td>
                            <td><?php echo $dato['dni']; ?></td>
                            <td><?php echo $dato['CMP']; ?></td>
                            <td><?php echo $dato['nombre']; ?></td>
                            <td><?php echo $dato['apPaterno']; ?></td>
                            <td><?php echo $dato['apMaterno']; ?></td>
                            <td><?php echo !empty($dato['telef']) ? $dato['telef'] : 'Aun sin registro' ?></td>
                            <td><?php echo !empty($dato['fecNac']) ? date('d-m-Y', strtotime($dato['fecNac'])) : 'Aun sin registro';
                                ?></td>
                            <td><?php echo $dato['domicilio']; ?></td>
                            <td><?php echo $dato['email']; ?></td>
                            <td><?php echo isset($dato['RNE']) ? $dato['RNE'] : "Sin ingreso"; ?></td>
                            <td><?php
                                $tipoSocioId = $dato['tipoSocio'];
                                echo isset($sociotipo[$tipoSocioId]) ? $sociotipo[$tipoSocioId] : 'Sin ingreso';
                                ?>
                            </td>
                            <td><?php
                                $sedeId = $dato['sede'];
                                echo isset($sedes[$sedeId]) ? $sedes[$sedeId] : 'Sin Ingreso';
                                ?>
                            </td>

                            <td>
                                <?php
                                $especialidadesSeleccionadas = explode(',', $dato['especialidad']);
                                $especialidadesNombres = array_map(function ($id) use ($especialidadesArray) {
                                    return isset($especialidadesArray[$id]) ? $especialidadesArray[$id] : 'Especialidad Desconocida';
                                }, $especialidadesSeleccionadas);
                                echo implode(', ', $especialidadesNombres);
                                ?>

                            </td>
                            <td>
                                <?php
                                // Check the condition

                                if ($dato["condicion"] == 1) {
                                    // If the condition is true, echo "Habilitado"
                                    echo "Habilitado";
                                } else {
                                    // If the condition is false, echo "No habilitado"
                                    echo "No habilitado";
                                }
                                ?>

                            <td>


                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">Acción</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="<?= base_url('panel/ver/' . $dato['idSocio']) ?>">Ver</a>
                                        <a class="dropdown-item" href="<?= base_url('panel/editar/' . $dato['idSocio']) ?>">Editar</a>
                                        <a class="dropdown-item" href="<?= base_url('panel/eliminar/' . $dato['idSocio']) ?>">Eliminar</a>

                                    </div>
                                </div>

                            </td>

                        </tr>
                    <?php endforeach; ?>

                <tfoot>
                    <tr>
                    <tr>
                        <th>ID</th>
                        <th>DNI</th>
                        <th>Foto</th>
                        <th>CMP</th>
                        <th>Nombre</th>
                        <th>Ap.Paterno</th>
                        <th>Ap.Materno</th>
                        <th>Teléfono</th>
                        <th>Fec.Nac</th>
                        <th>Domicilio</th>
                        <th>Email</th>
                        <th>RNE</th>
                        <th>Sede</th>
                        <th>Tipo Socio</th>
                        <th>Especialidad</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <?= $this->endSection() ?>

        <?= $this->section('scripts') ?>
        <script>
            var table = $('#tablaSocios').DataTable({
                "dom": 'Bfrtip',
                "buttons": [
                    'pageLength',
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    ['05 Resultados', '10 Resultados', '25 Resultados', '50 Resultados', 'Motrar Todos']
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