/* Jalar la Plantilla "Principal" /*
<?php echo $this->extend('Admin/layout/principal') ?>

<?= $this->section('titulo') ?>
<?php echo  $titulo ?>
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
    <div class="container">
        ffffffffffff
        <br>
        <hr>
        <br>
        <div class="row">
            <div class="col-md-12 text-center">
                <h2><strong><?= $socio['apPaterno']; ?> <?= $socio['apMaterno']; ?>, <?= $socio['nombre'] ?></strong></h2>
                <hr>
            </div>
            <form action="<?php echo base_url('/panels/update') . "/" . $socio['idSocio']; ?>" method="post" enctype="multipart/form-data">
                <!-- <input type="hidden" name="_method" value="PUT"/> -->
                <?= csrf_field(); ?>
                <div class="col-md-12">
                    <div class="row align-items-center">
                        <div class="col-sm-4 overflow-hidden">
                            <img class="mb-2 rounded" src="<?= base_url('/uploads/' . $socio['foto']) ?>" alt="Foto del usuario" width="100%">
                            <div class="alert <?php echo ($socio["condicion"] == 1) ? 'alert-success' : 'alert-danger'; ?> mt-2 text-center font-weight-bold" role="alert">
                                <?php
                                // Check the condition
                                if ($socio["condicion"] == 1) {
                                    // If the condition is true, echo "Habilitado"
                                    echo "HABILITADO";
                                } else {
                                    // If the condition is false, echo "No habilitado"
                                    echo "NO HABILITADO";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-8 text-dark">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="text-muted"><strong>Tipo Socio</strong></h6>
                                    <p><?php
                                        $tipoSocioId = $socio['tipoSocio'];
                                        echo isset($sociotipo[$tipoSocioId]) ? $sociotipo[$tipoSocioId] : 'Sin ingreso';
                                        ?></p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="text-muted"><strong>Sede</strong></h6>
                                    <p> <?php
                                        $sedeId = $socio['sede'];
                                        echo isset($sedes[$sedeId]) ? $sedes[$sedeId] : 'Sin Ingreso';
                                        ?></p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="text-muted"><strong>Colegiatura CMP</strong></h6>
                                    <p><?= $socio['CMP']; ?></p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="text-muted"><strong>Documento Identidad</strong></h6>
                                    <p><?= $socio['dni']; ?></p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="text-muted"><strong>Correo electrónico</strong></h6>
                                    <p><?= $socio['email']; ?></p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="text-muted"><strong>Teléfono móvil</strong></h6>
                                    <p><?= $socio['telef']; ?></p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="text-muted"><strong>Fecha Nacimiento</strong></h6>
                                    <p><?= $socio['fecNacFormatted']; ?></p>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="text-muted"><strong>RNE</strong></h6>
                                    <p><?php echo isset($dato['RNE']) ? $dato['RNE'] : "Sin ingreso"; ?></p>
                                </div>

                                <div class="col-12">
                                    <div class="dropdown-divider"></div>
                                </div>

                                <div class="col-sm-12">
                                    <h6 class="text-muted"><strong>Especialidad(es)</strong></h6>
                                    <p> <?php
                                        $especialidadesSeleccionadas = explode(',', $socio['especialidad']);
                                        $especialidadesNombres = array_map(function ($id) use ($especialidadesArray) {
                                            return isset($especialidadesArray[$id]) ? $especialidadesArray[$id] : 'Especialidad Desconocida';
                                        }, $especialidadesSeleccionadas);
                                        echo implode(', ', $especialidadesNombres);
                                        ?></p>
                                </div>
                                <div class="col-sm-12">
                                    <h6 class="text-muted"><strong>Dirección</strong></h6>
                                    <p><?= $socio['domicilio']; ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <br />
        <br />
        <div class="row">
            <div class="text-center col-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Sólo de manipulación por personal autorizado <i class="fas fa-exclamation-triangle text-danger"></i></h3>
                        <p>Queda constancia que cualquier cambio es resposabilidad sólo del Administrador. </p>
                        <a href="<?= base_url('panel/editar/' . $socio['idSocio']) ?>" class="btn btn-primary">Editar</a>
                        <a href="<?= base_url('/panel/socio') ?>" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>

        </div>
        <br>
        <br>
        <br>
        <hr>

    </div>

    <?= $this->endSection() ?>

    <?= $this->section('scripts') ?>

    <?= $this->endSection() ?>