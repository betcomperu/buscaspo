
<?php echo $this->extend('Admin/layout/principal') ?>

<?= $this->section('titulo') ?>
   <?php echo  $titulo ?>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<?php 
echo session()->get('nombre');
?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<?= $this->endSection() ?>