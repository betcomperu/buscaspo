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
    
        <?php
        echo session()->getFlashdata('info');
        ?>
    <div class="container">

        <form>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" class="form-control" placeholder="Ingrese documento de identidad" name="dni" id="dni" value="<?= old('dni') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Ingrese el Nombre" name="nombre" value="<?= old('nombre') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="apPaterno" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apPaterno" placeholder="Ingrese apellido paterno" name="apPaterno" value="<?= old('apPaterno') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="apMaterno" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="apMaterno" placeholder="Ingrese apellido materno" name="apMaterno" value="<?= old('apMaterno') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="cmp" class="form-label">CMP</label>
                        <input type="text" class="form-control" id="CMP" placeholder="Ingrese en CMP" name="CMP" value="<?= old('CMP') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="rne" class="form-label">RNE</label>
                        <input type="text" class="form-control" id="RNE" placeholder="Ingrese el RNE" name="RNE" value="<?= old('RNE') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="especialidad" class="form-label">Especialidad</label>
                        <select class="form-control" name="especialidad[]" id="especialidad" multiple>
                            <option value="" disabled>Seleccione la(s) Especialidad(es)</option>
                            <?php foreach ($espe as $dato) : ?>
                                <option value="<?php echo $dato['idEspecialidad']; ?>">
                                    <?php echo $dato['descripcion']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>


                    </div>




                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fecNac" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fecNac" name="fecNac" id="fecNac">
                    </div>


                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control-file" id="foto" name="foto">
                            <span>Ingrese una imagen 250x250px exacto en formato jpg</span>
                        </div>
                        <div class="col-md-6"></div>
                        <label for="sede" class="form-label">Sede</label>
                        <select class="form-control" name="tiposocio" id="tiposocio">
                            <option value="" disabled selected>Seleccione la Sede</option>
                            <?php foreach ($sede as $sedes) : ?>
                                <option value="<?php echo $sedes['idSede']; ?>">
                                    <?php echo $sedes['sede']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sede" class="form-label">Tipo de Socio</label>
                        <select class="form-control" name="tiposocio" id="tiposocio">
                            <option value="" disabled selected>Seleccione el tipo</option>
                            <?php foreach ($tiposocio as $tipo) : ?>
                                <option value="<?php echo $tipo['idTipoSocio']; ?>">
                                    <?php echo $tipo['descripcion']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="domicilio" class="form-label">Domicilio</label>
                        <input type="text" class="form-control" id="domicilio" placeholder="Av.Brasil 1111, Lima, Pueblo Libre" name="domicilio" value="<?= old('domicilio') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="regSanitario" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" placeholder="Ingrese Correo electrónico" name="email" value="<?= old('email') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" placeholder="Ingrese un Celular o Fijo" name="telef" value="<?= old('telef') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="sede" class="form-label">Condición</label>
                        <select class="form-control" id="condicion" name="condicion">
                            <option selected>Seleccione la condición</option>
                            <option value="1">Habilitado</option>
                            <option value="2">Inhabilitado</option>
                        </select>
                    </div>


                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-danger">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Registrar Socio</button>
                </div>

            </div>
    </div>
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Bootstrap Datepicker -->
<?= $this->endSection() ?>