<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Home de admin <?= APP_NAME ?></title>
    <?= $template->css() ?>
</head>

<body>
    <?= $template->login() ?>
    <?= $template->header('Home de admin') ?>
    <?= $template->menu() ?>
    <?= $template->breadCrumbs([
        'Temas' => null
    ]) ?>
    <?= $template->messages() ?>
    <script src="/js/BigPicture.js"></script>
    <main>
        <section class="flex-container" id="user-data">
            <div class="flex2">
                <h2><?="Home de $user->displayname"?></h2>

                <p><b>Nombre:</b>               <?= $user->displayname ?></p> 
                <p><b>Email:</b>                <?= $user->email ?></p> 
                <p><b>Teléfono:</b>             <?= $user->phone ?></p> 
                <p><b>Fecha de alta:</b>        <?= $user->created_at ?></p> 
                <p><b>Última modificación:</b>  <?= $user->updated_at ?? '--'?></p>
            </div>
            <!-- Esta parte solamente si creáis -->
             <figure class="flex1 centrado">
                <img src="<?= USER_IMAGE_FOLDER.'/'.($user->picture ?? DEFAULT_USER_IMAGE)?>" class="cover enlarge-image" alt="Imagen de perfil de <?= $user->displayname ?>">
                <figcaption>Imagen de perfil de <?= $user->displayname ?></figcaption>
             </figure>
        </section>