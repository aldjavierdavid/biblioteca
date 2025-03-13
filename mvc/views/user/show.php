<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalles del Usuario</title>
    <script src="/js/BigPicture.js"></script>
    <?= $template->css() ?>
</head>

<body>
    <?= $template->login() ?>
    <?= $template->header('Lista de libros') ?>
    <?= $template->menu() ?>
    <?= $template->breadCrumbs([
        'Usuarios' => $user->displayname 
    ]) ?>
    <?= $template->messages() ?>
    <main>
        <h1><?= APP_NAME ?> </h1>
        <section id="detalles" class="flex-container gap2">
            <div class="flex2">
            <h2><?= $user->displayname?></h2>
            
            <p><b>Nombre de usuario:</b> <?= $user->displayname ?></p>
            <p><b>Correo electrónico:</b> <?= $user->email ?></p>
            <p><b>Teléfono:</b> <?= $user->phone ?></p>
            <p><b>Roles: <?= $user->roles ?></b></p>
            
            <figure id="" class="flex1 centrado p2">
                <img src="<?=USER_IMAGE_FOLDER.'/'.($user->picture ?? DEFAULT_USER_IMAGE)?>" 
                class="cover enlarge-image" 
                alt="Foto de perfil del usuario: <?= $user->displayname ?>">
                <figcaption>Foto de perfil del usuario: <?= $user->displayname ?></figcaption>
            </figure>

            <div class="centered">
                <a class="button" onclick="history.back()">Atrás</a>
                <a class="button" href="/User/list">Lista de socios</a>
                <a class="button" href="/User/edit/<?= $user->id ?>">Editar</a>
                <a class="button" href="/User/delete/<?= $user->id ?>">Borrar</a>
            </div>
            </div>
        </section>
