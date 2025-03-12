<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de administrador <?= APP_NAME ?></title>
    <?= $template->css() ?>
</head>

<body>
    <?= $template->login() ?>
    <?= $template->header('Panel de administrador') ?>
    <?= $template->menu() ?>
    <?= $template->breadCrumbs([
        'Temas' => null
    ]) ?>
    <?= $template->messages() ?>
    <main>
        <h1>Panel del administrador</h1>

        <p>Aquí encontrarás los enlaces a las distintas operaciones para el administrador de la aplicación "BiblioCifo".</p>

        <div class="flex-container gap2">
            <section class="flex1">
                <h2>Operaciones con usuarios</h2>
                <ul>
                    <li><a href='/User'>Lista de usuarios</a></li>
                    <li><a href='/User/create'>Nuevo usuario</a></li>
                </ul>
            </section>
        </div>
    </main>