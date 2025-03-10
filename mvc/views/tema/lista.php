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
        <?php 

// si hay filtro guardado en sesion...
if($filtro){

    // pone el formulario de quitar filtro
    // el metodo removeFilterForm necesita conocer el filtro
    // y la ruta a la que se envia el formulario
    echo $template->removeFilterForm($filtro, '/Tema/list');
}else{
    // pone el formulario de nuevo filtro
    echo $template->filterForm(

        // lista de campos para el desplegable "buscar en"
        [
            'Tema' => 'tema',
            'Descripcion' => 'descripcion',
        ],
        // lista de campos para el desplegable "ordenado por"
        [
            'Tema' => 'tema',
            'Descripcion' => 'descripcion',
        ],
        // valor por defecto para buscar en
        'Tema',
        // valor por defecto para "ordenado por"
        'Tema'
    );
} ?>
        <div class="right">
                <?= $paginator->stats() ?>
            </div>
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
                    <td class="centrado">
                      <a class="button" href="/Tema/show/<?= $tema->id ?>">Ver detalles</a>
                      <a class="button" href="/Tema/edit/<?= $tema->id ?>">Editar tema</a>
                      <?php if(!$tema->ejemplares){ ?>
                      <a class="button" href="/Tema/delete/<?= $tema->id ?>">Borrar tema</a>
                      <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <?= $paginator->ellipsisLinks() ?>
</body>

</html>