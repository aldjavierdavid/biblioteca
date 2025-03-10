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
        <?php 

// si hay filtro guardado en sesion...
if($filtro){

    // pone el formulario de quitar filtro
    // el metodo removeFilterForm necesita conocer el filtro
    // y la ruta a la que se envia el formulario
    echo $template->removeFilterForm($filtro, '/Prestamo/list');
}else{
    // pone el formulario de nuevo filtro
    echo $template->filterForm(

        // lista de campos para el desplegable "buscar en"
        [
            'ID' => 'id',
            'Nombre' => 'nombre',
            'Ejemplar' => 'idejemplar', 
            'Título' => 'titulo'
        ],
        // lista de campos para el desplegable "ordenado por"
        [
            'ID' => 'id',
            'Nombre' => 'nombre',
            'Ejemplar' => 'idejemplar', 
            'Título' => 'titulo'
        ],
        // valor por defecto para buscar en
        'ID',
        // valor por defecto para "ordenado por"
        'ID'
    );
} ?>

        <div class="right">
                <?= $paginator->stats() ?>
            </div>
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
        <?= $paginator->ellipsisLinks() ?>
</body>

</html>