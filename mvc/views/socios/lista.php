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
        <?php 

// si hay filtro guardado en sesion...
if($filtro){

    // pone el formulario de quitar filtro
    // el metodo removeFilterForm necesita conocer el filtro
    // y la ruta a la que se envia el formulario
    echo $template->removeFilterForm($filtro, '/Socio/list');
}else{
    // pone el formulario de nuevo filtro
    echo $template->filterForm(

        // lista de campos para el desplegable "buscar en"
        [
            'Nombre' => 'nombre',
            'DNI' => 'DNI',
            'Email' => 'email', 
            'Poblacion' => 'poblacion'
        ],
        // lista de campos para el desplegable "ordenado por"
        [
            'Nombre' => 'nombre',
            'DNI' => 'DNI',
            'Email' => 'email', 
            'Poblacion' => 'poblacion'
        ],
        // valor por defecto para buscar en
        'Nombre',
        // valor por defecto para "ordenado por"
        'Nombre'
    );
} ?>
        <div class="right">
                <?= $paginator->stats() ?>
            </div>
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
        <?= $paginator->ellipsisLinks() ?>
</body>

</html>