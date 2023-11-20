<?php echo $this->extend('Admin/layout/principal') ?>

<?= $this->section('titulo') ?>

<?= $this->endSection() ?>

<?= $this->section('contenido') ?>

<?php $this->extend('layouts/default'); ?>

<?php $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Perfil del Socio</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h2>Datos Personales</h2>
            <table class="table table-bordered">
                <tr>
                    <th>Foto</th>
                    <td><img src="<?= base_url('/uploads/default.png') ?>" alt="foto" class="img-thumbnail"></td>
                </tr>
                <tr>
                    <th>DNI</th>
                    <td><?= $socio['dni']; ?></td>
                </tr>
                <tr>
                    <th>CMP</th>
                    <td><?= $socio['CMP']; ?></td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td><?= $socio['nombre'] ?></td>
                </tr>
                <tr>
                    <th>Apellido Paterno</th>
                    <td><?= $socio['apPaterno']; ?></td>
                </tr>
                <tr>
                    <th>Apellido Materno</th>
                    <td><?= $socio['apMaterno']; ?></td>
                </tr>
                <tr>
                    <th>Teléfono</th>
                    <td><?= $socio['telef']; ?></td>
                </tr>
                <tr>
                    <th>Fecha de Nacimiento</th>
                    <td><?= $socio['fecNac'];?></td>
                </tr>
                <tr>
                    <th>Domicilio</th>
                    <td><?= $socio['domicilio']; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= $socio['email']; ?></td>
                </tr>
                <tr>
                    <th>RNE</th>
                    <td><?= $socio['RNE']; ?></td>
                </tr>
                <tr>
                    <th>Tipo Socio</th>
                    <td><?= $socio['tipoSocio']; ?></td>
                </tr>
                <tr>
                    <th>Sede</th>
                    <td><?= $socio['sede']; ?></td>
                </tr>
                <tr>
                    <th>Especialidades</th>
                    <td><?= $socio['especialidad']; ?></td>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td><?= $socio['condicion'];?></td>
                </tr>
            </table>
            <a href="<?= base_url('socio/editar/' . $socio['idSocio']) ?>" class="btn btn-primary">Editar</a>
            <a href="<?= base_url('socio') ?>" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Bootstrap Datepicker -->
<?= $this->endSection() ?>