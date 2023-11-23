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
    <div class="container">
        FFFFFF
        <br>
        <hr>
        <br>
        <div class="row">

            <div class="col-md-12 text-center">
                <h2><strong><?= $socio['apPaterno']; ?> <?= $socio['apMaterno']; ?>, <?= $socio['nombre'] ?></strong></h2>
                <hr>
            </div>
            <form action="<?php echo base_url('/panel/actualizar') . "/" . $socio['idSocio'] ?>" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="row align-items-center">
                        <div class="col-sm-4 overflow-hidden">
                            <img class="mb-2 rounded" src="<?= base_url('/uploads/' . $socio['foto']) ?>" alt="Foto del usuario" width="100%">
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
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control-file" id="foto" name="foto">
                                <span>Ingrese una imagen 250x250px exacto en formato jpg</span>
                            </div>
                            <div class="mb-3">
                                <label for="condicion" class="form-label">Condición</label>
                                <select class="form-control" id="condicion" name="condicion">
                                    <option value="1" <?= ($socio['condicion'] == 1) ? 'selected' : ''; ?>>Habilitado</option>
                                    <option value="2" <?= ($socio['condicion'] == 2) ? 'selected' : ''; ?>>Inhabilitado</option>
                                </select>
                                <small id="nombreHelp" class="form-text text-muted">Cuidado, seleccione Habilitado o Inhabilitado</small>
                                <p class="text text-danger"><?= session('errors.condicion') ?></p>


                            </div>
                        </div>


                        <div class="col-sm-8 text-dark">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="tipoSocio" class="form-label">Tipo de Socio</label>
                                    <select class="form-control" name="tipoSocio" id="tipoSocio">
                                        <option value="" disabled selected>Seleccione el tipo Socio</option>
                                        <?php foreach ($tiposocio as $tipo) : ?>
                                            <option value="<?php echo $tipo['idTipoSocio']; ?>" <?= $tipo['idTipoSocio'] == $socio['tipoSocio'] ? 'selected' : '' ?>>
                                                <?php echo $tipo['descripcion']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <p class="text text-danger"><?= session('errors.tiposocio') ?></p>
                                </div>
                                <div class="col-sm-6">
                                    <label for="sede" class="form-label">Sede</label>
                                    <select class="form-control" name="sede" id="sede">
                                        <?php foreach ($sede as $s) : ?>
                                            <option value="<?php echo $s['idSede']; ?>" <?= $s['idSede'] == $socio['sede'] ? 'selected' : '' ?>>
                                                <?php echo $s['sede']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <p class="text text-danger"><?= session('errors.sede') ?></p>
                                </div>
                                <div class="col-sm-6">
                                    <label for="CMP" class="form-label">CMP</label>
                                    <input type="text" class="form-control" id="CMP" placeholder="Ingrese en CMP" name="CMP" value="<?= $socio['CMP'] ?>">
                                    <p class="text text-danger"><?= session('errors.CMP') ?></p>
                                </div>
                                <div class="col-sm-6">
                                    <label for="dni" class="form-label">DNI</label>
                                    <input type="text" class="form-control" placeholder="Ingrese documento de identidad" name="dni" id="dni" value="<?= $socio['dni'] ?>">
                                    <small id="nombreHelp" class="form-text text-muted">(*)Obligatorio, ingrese un DNI de 8 digitos numericos.</small>
                                    <p class="text text-danger"><?= session('errors.dni') ?></p>
                                </div>
                                <div class="col-sm-6">
                                    <label for="regSanitario" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="Ingrese Correo electrónico" name="email" value="<?= $socio['email'] ?>">
                                    <p class="text text-danger"><?= session('errors.email') ?></p>
                                </div>
                                <div class="col-sm-6">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" placeholder="Ingrese un Celular o Fijo" name="telef" value="<?= $socio['telef'] ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="fecNac" class="form-label">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="fecNac" name="fecNac" value="<?= $socio['fecNac'] ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="rne" class="form-label">RNE</label>
                                    <input type="text" class="form-control" id="RNE" placeholder="Ingrese el RNE" name="RNE" value="<?= $socio['RNE'] ?>">
                                </div>

                                <div class="col-12">
                                    <div class="dropdown-divider"></div>
                                </div>

                                <div class="col-sm-12">
                                    <h6 class="text-muted"><strong>Especialidad(es)</strong></h6>
                                    <select class="form-control" name="especialidad[]" id="especialidad" multiple>
                                        <?php foreach ($espe as $dato) : ?>
                                            <option value="<?php echo $dato['idEspecialidad']; ?>" <?= in_array($dato['idEspecialidad'], explode(',', $socio['especialidad'])) ? 'selected' : '' ?>>
                                                <?php echo $dato['descripcion']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <small id="nombreHelp" class="form-text text-muted">(*)Obligatorio, Seleccione una especialidad y varias presionando la tecla Ctrl.</small>
                                    <p class="text text-danger"><?= session('errors.especialidad') ?></p>
                                </div>


                                <div class="col-sm-12">
                                    <label for="domicilio" class="form-label">Domicilio</label>
                                    <input type="text" class="form-control" id="domicilio" placeholder="Av.Brasil 1111, Lima, Pueblo Libre" name="domicilio" value="<?= $socio['domicilio'] ?>">
                                    <p class="text text-danger"><?= session('errors.domicilio') ?></p>
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
                        <button type="submit" class="btn btn-primary editar"><i class="fa fa-plus-circle"></i> Actualizar</button>
                        <a href="<?= base_url('/panel/socio') ?>" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>

        </div>
        </form>
        <br>
        <br>
        <br>
        <hr>

    </div>

    <?= $this->endSection() ?>

    <?= $this->section('scripts') ?>

    <!-- Script para mostrar el nombre en lugar del valor al seleccionar -->
    <script>
        document.getElementById('especialidad').addEventListener('change', function() {
            var select = this;
            var selectedOptions = Array.from(select.selectedOptions);
            selectedOptions.forEach(function(option) {
                option.textContent = select.options[option.index].text;
            });
        });
    </script>
    <!-- Bootstrap Datepicker -->
    <?= $this->endSection() ?>