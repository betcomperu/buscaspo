<?php echo $this->extend('Admin/layout/principal') ?>

<?= $this->section('titulo') ?>

<?= $this->endSection() ?>
<?= $this->section('estilos') ?>
<!-- CSS Developer -->
<link rel="stylesheet" href="<?php echo base_url('/admin/'); ?>developer.css">
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
            <a href="<?php echo base_url(); ?>panel/especialidades" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Ver Especialidades </a>
            <a href="<?php echo base_url(); ?>panel/especialidades/eliminados" class="btn btn-warning"><i class="fas fa-list-ol"></i> Ver Eliminados
            </a>
            <div class="box-tools pull-right">
                <br>
            </div>
        </div>


       
<form action="<?php echo base_url(); ?>panel/especialidades/grabar" method="post" enctype="multipart/form-data>
    <div class="col-6">
        <label for="especialidad" class="form-label">Especialidad</label>
        <input type="text" class="form-control" id="especialidad" name="descripcion" placeholder="Ingrese su especialidad" value="<?= $especialidad['descripcion'] ?>">
        <p class="text text-danger"><?= session('errors.descripcion') ?></p>
      
    </div><br>
  
    <div class="col-6 espacio-extra"> 
        <label for="estado" class="form-label">Estado</label>
        <select class="form-control" id="sitReg" name= "sitReg" value="<?= old('sitReg') ?>">
            <option selected>Seleccione su estado</option>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>
        <p class="text text-danger"><?= session('modelErrors.sitReg.required') ?></p>
        
    
       
    </div>
    <button type="submit" class="btn btn-primary">Registrar</button>
    <button type="submit" class="btn btn-danger">Cancelar</button>
</form>

        <?= $this->endSection() ?>

        <?= $this->section('scripts') ?>
        
        <?= $this->endSection() ?>