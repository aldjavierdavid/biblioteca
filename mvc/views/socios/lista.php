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
                    <td>
                        <a href="/Socio/show/<?= $socio->id ?>">Ver datos </a>
                        <a href="/Socio/edit/<?= $socio->id ?>">Editar datos </a>
                        <?php if (!$socio->prestamos) { ?>
                            <a href="/Socio/delete/<?= $socio->id ?>">Borrar socio</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <div class="centrado">
            <a class="button" href="index.php?controlador=libro/list">Lista de libros</a>
        </div>
</body>

</html>