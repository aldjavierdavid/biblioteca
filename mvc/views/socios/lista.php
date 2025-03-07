<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Actualizar libro</title>
    <?= $template->css() ?>
</head>

<body>
    <?= $template->login() ?>
    <?= $template->header('Lista de libros') ?>
    <?= $template->menu() ?>
    <?= $template->breadCrumbs([
        'Libros' => null
    ]) ?>
    <?= $template->messages() ?>
    <main>
        <h1><?= APP_NAME ?></h1>
        <h2>Lista de socios</h2>
        <table class="table w100">
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Población</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($socios as $socio) { ?>
                <tr>
                    <td><?= $socio->dni ?></td>
                    <td><?= $socio->nombre . " " . $socio->apellidos ?></td>
                    <td><?= $socio->poblacion ?></td>
                    <td><?= $socio->telefono ?></td>
                    <td><?= $socio->email ?></td>
                    <td class="centrado">
                        <a href="/Socio/show/<?= $socio->id ?>" class="button">Ver datos </a>
                        <a href="/Socio/edit/<?= $socio->id ?>" class="button">Editar datos </a>
                        <?php if (!$socio->hasAny('Prestamo')) { ?>
                            <a href="/Socio/delete/<?= $socio->id ?>" class="button">Borrar socio</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
</body>

</html>