<?php echo $this->extend('Admin/layout/principal') ?>

<?= $this->section('titulo') ?>
<?php echo  $titulo ?>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<h4>Lisado de Usuarios y administradores</h4>

<div class="container">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Usuario</th>
                <th scope="col">Condición</th>
                <th scope="col" colspan="2">Acciones</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <th scope="row"><?= $user->idUsuario ?></th>
                    <td><?= $user->nombre ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->usuario ?></td>

                    <td>
                        <?php if ($user->condicion == 1) : ?>
                            <p class="text-success">Habilitado</p>
                        <?php else : ?>
                            <p class="text-danger">Deshabilitado</p>
                        <?php endif; ?>
                    </td>
                    <td><button type="button" class="btn btn-primary btn-block"><i class="fa fa-bell"></i> Editar</button></td>
                    <td><button type="button" class="btn btn-danger btn-block"><i class="fa fa-bell"></i> Eliminar</button></td>


                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<?= $this->endSection() ?>