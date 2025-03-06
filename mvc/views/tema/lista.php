<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de temas - <?= APP_NAME ?></title>
    <?= $template->css() ?>
</head>

<body>
    <?= $template->login() ?>
    <?= $template->header('Lista de libros') ?>
    <?= $template->menu() ?>
    <?= $template->breadCrumbs([
        'Temas' => null
    ]) ?>
    <?= $template->messages() ?>
    <main>
        <h1><?= APP_NAME ?></h1>
        <h2>Lista de temas</h2>
        <table class="table w100">
            <tr>
                <th>Tema</th>
                <th>Descripción</th>
                <th>Operaciones</th>
            </tr>
            <?php foreach ($temas as $tema) { ?>
                <tr>
                    <td><?= $tema->tema ?></td>
                    <td><?= $tema->descripcion ?></td>
                    <td>
                      <a href="/Tema/show/<?= $tema->id ?>">Ver detalles</a>
                      <a href="/Tema/edit/<?= $tema->id ?>">Editar tema</a>
                      <a href="/Tema/delete/<?= $tema->id ?>">Borrar tema</a>
                        
                    </td>
                </tr>
            <?php } ?>
        </table>
</body>

</html>