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

<div class="container mt-5">
    <h2>Datos Personales  FFFFF</h2>
    <br>
    <div class="row">

        <div class="col-md-4">
            <td><img src="<?= base_url('/uploads/' . $socio['foto']) ?>" alt="<?= $socio['nombre'] ?>" class="img-thumbnail"></td>
            <div class="alert alert-success mt-2 text-center font-weight-bold" role="alert">
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


        <div class="col-md-8 profile-details">
            <h2><?= $socio['nombre'] ?> <?= $socio['apPaterno']; ?> <?= $socio['apMaterno']; ?></h2>
            <p><strong>DNI:</strong> <?= $socio['dni']; ?></p>
            <p><strong>Tipo de Socio:</strong> <?php
                                $tipoSocioId = $socio['tipoSocio'];
                                echo isset($sociotipo[$tipoSocioId]) ? $sociotipo[$tipoSocioId] : 'Sin ingreso';
                                ?></p>
            <p><strong>Colegiatura CMP:</strong> <?= $socio['CMP']; ?></p>
            <p><strong>Especialidad(es):</strong>
            <?php
                        $especialidadesSeleccionadas = explode(',', $socio['especialidad']);
                        $especialidadesNombres = array_map(function ($id) use ($especialidadesArray) {
                            return isset($especialidadesArray[$id]) ? $especialidadesArray[$id] : 'Especialidad Desconocida';
                        }, $especialidadesSeleccionadas);
                        echo implode(', ', $especialidadesNombres);
                        ?>

            </p>
            <p><strong>Email:</strong> <?= $socio['email']; ?></p>
            <p><strong>Teléfono Móvil:</strong> <?= $socio['telef']; ?></p>

            <hr>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Fecha de Nac.:</strong> <?= $socio['fecNac']; ?></p>
                    <p><strong>Domicilio:</strong> <?= $socio['domicilio']; ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Sede:</strong>

                    <?php
                                $sedeId = $socio['sede'];
                                echo isset($sedes[$sedeId]) ? $sedes[$sedeId] : 'Sin Ingreso';
                                ?>

                    </p>
                    <p><strong>RNE :</strong> <?php echo isset($dato['RNE']) ? $dato['RNE'] : "Sin ingreso"; ?></p>
                </div>
            </div>
        </div>
        <div>
            
            <a href="<?= base_url('socio/editar/' . $socio['idSocio']) ?>" class="btn btn-primary">Editar</a>
            <a href="<?= base_url('/panel/socio') ?>" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<?= $this->endSection() ?>