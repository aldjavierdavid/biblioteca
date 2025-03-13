<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de libros - <?= APP_NAME ?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lista de libros en <?= APP_NAME?>">
    <meta name="author" content="Robert Sallent">

    <link rel="shortcut icon" href="/favicon.icon" type="image/png">

    <?= $template->css() ?>
</head>

<body>
    <?= $template -> login() ?>
    <?= $template->header('Lista de libros')?>
    <?= $template->menu()?>
    <?= $template->breadCrumbs([
        'Libros' => null
    ]) ?>
    <?= $template->messages()?>
    <main>
        <h1><?= APP_NAME ?></h1>
        <h2>Lista completa de libros</h2>

        <!-- FILTRO DE BUSQUEDA --> 
        <?php 

        // si hay filtro guardado en sesion...
        if($filtro){

            // pone el formulario de quitar filtro
            // el metodo removeFilterForm necesita conocer el filtro
            // y la ruta a la que se envia el formulario
            echo $template->removeFilterForm($filtro, '/Libro/list');
        }else{
            // pone el formulario de nuevo filtro
            echo $template->filterForm(

                // lista de campos para el desplegable "buscar en"
                [
                    'Titulo' => 'titulo',
                    'Editorial' => 'editorial',
                    'Autor' => 'autor', 
                    'ISBN' => 'isbn'
                ],
                // lista de campos para el desplegable "ordenado por"
                [
                    'Titulo' => 'titulo',
                    'Editorial' => 'editorial',
                    'Autor' => 'autor', 
                    'ISBN' => 'isbn'
                ],
                // valor por defecto para buscar en
                'Titulo',
                // valor por defecto para "ordenado por"
                'Titulo'
            );
        } ?>

        <?php if($libros) { ?>
            <div class="right">
                <?= $paginator->stats() ?>
            </div>
            <table class="table w100">
                <tr>
                    <th>Portada</th>
                    <th>ISBN</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Ejemplares</th>
                    <th class="centrado">Operaciones</th>
                </tr>
            
        <?php foreach($libros as $libro){ ?>
            <tr>
                <td class='centrado'>
                <a href="/Libro/show/<?= $libro->id ?>">
                    <img class="table-image" src="<?=BOOK_IMAGE_FOLDER.'/'.($libro->portada ?? DEFAULT_BOOK_IMAGE)?>" alt="Portada de <?= $libro->titulo ?>"
                    title="Portada de <?= $libro->titulo ?>">
                </a>

                </td>
                <td><?= $libro->isbn ?></td>
                <td><?=$libro->titulo?></a></td>
                <td><?=$libro->autor?></td>
                <td><?=$libro->ejemplares?></td>
                <td class="centrado">
                    <a class="button" href="/Libro/show/<?= $libro->id ?>">Ver</a>
                    <?php if(Login::oneRole(['ROLE_LIBRARIAN, ROLE_TEST'])){ ?>
                    <a class="button" href="/Libro/edit/<?= $libro->id ?>">Editar</a>

                    <?php if(!$libro->ejemplares){ ?>
                    <a class="button" href="/Libro/delete/<?= $libro->id ?>">Borrar</a>
                    <?php } ?>
                <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </table>
        <?= $paginator->ellipsisLinks() ?>
        <?php }else{ ?>
            <div class="danger p2">
                <p>No hay libros que mostrar.</p>
            </div>
        <?php } ?>
        <div class="centered">
            <a class="button" onclick="history.back()">Atrás</a>
        </div>
    
    </main>
    <?= $template->footer() ?>
</body>

</html>