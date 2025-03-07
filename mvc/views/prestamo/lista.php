<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de prestamos</title>
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
        <h2>Lista de prestmos</h2>
        <table class="table w100">
            <tr>
                <th>ID</th>
                <th>Socio</th>
                <th>Ejemplar</th>
                <th>Título</th>
                <th>Límite</th>
                <th>Devolución</th>
            </tr>
            <?php foreach ($prestamos as $prestamo) { ?>
                <tr>
                    <td><?= $prestamo->id ?></td>
                    <td><a href="/Socio/show/<?=$prestamo->idsocio?>"><?= $prestamo->nombre . " " . $prestamo->apellidos ?></a></td>
                    <td><?= $prestamo->idejemplar ?></td>
                    <td><?= $prestamo->titulo ?></td>
                    <td><?= $prestamo->limite ?></td>
                    <td><?= $prestamo->devolucion ?></td>
                </tr>
            <?php } ?>
        </table>
</body>

</html>