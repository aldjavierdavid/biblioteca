<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar datos de usuario - <?= APP_NAME ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lista de libros en <?= APP_NAME ?>">
    <meta name="author" content="Robert Sallent">

    <link rel="shortcut icon" href="/favicon.icon" type="image/png">

    <script src="/js/Preview.js"></script>
    <?= $template->css() ?>
</head>

<body>
    <?= $template->login() ?>
    <?= $template->header('Editar user') ?>
    <?= $template->menu() ?>
    <?= $template->breadCrumbs([
        'Usuarios' => null
    ]) ?>
    <?= $template->messages() ?>
    <section id="detalles" class="flex-container gap2">
        <div class="flex2">
            <form method="POST" enctype="multipart/form-data" action="/User/update">
                <h1>Actualizar datos del user: <?= $user->displayname ?></h1>
                <input type="hidden" name='id' value="<?= $user->id ?>">

                <label>Nombre de usuario:</label>
                <input type="text" name="displayname" value="<?= $user->displayname ?>">
                <br>
                <label>Número de teléfono:</label>
                <input type="number" minlength="9" maxlength="9" name="phone" value="<?= $user->phone ?>">
                <br>
                <label>Email:</label>
                <input type="text" name="email" value="<?= $user->email ?>">
                <br>
                <label>Imagen de perfil</label>
                <input type="file" name="picture" accept="image/*" id="file-with-preview">
                <br>
                <label>Rol</label>
                <!-- 
                        Este desplegable se genera a partir de la lista de roles indicados en el fichero config.php
                        Añadid a esa lista el rol: 'Bibliotecario' => 'ROLE_LIBRARIAN'
                    -->
                <select name="roles">
                    <?php foreach (USER_ROLES as $roleName => $roleValue) { ?>
                        <option value="<?= $roleValue ?>"><?= $roleName ?></option>
                    <?php } ?>
                </select>
                
            
            <figure id="" class="flex1 centrado p2">
                <img src="<?= USER_IMAGE_FOLDER . '/' . ($user->picture ?? DEFAULT_USER_IMAGE) ?>"
                    class="cover enlarge-image"
                    alt="Foto de perfil del usuario <?= $user->displayname ?>">
                <figcaption>Foto de perfil actual del usuario <?= $user->displayname ?></figcaption>
            </figure>
            <figure class="flex1 centrado">
                <img src="<?= USER_IMAGE_FOLDER . '/' . DEFAULT_USER_IMAGE ?>"
                    id="preview-image" class="cover" alt="Previsualización de la imagen de perfil">
                <figcaption>Previsualización de la nueva imagen de perfil</figcaption>
                <div class="centrado mt2">
                    <input type="submit" class="button" name="actualizar" value="Actualizar">
                    <input type="reset" class="button" value="Reset">
                </div>
                </form>
            </figure>
        </div>
    </section>
    <div class="centered mt3">
        <a class="button" onclick="history.back()">Atrás</a>
        <a class="button" href="/User/list">Lista de usuarios</a>
        <a class="button" href="/User/show/<?= $user->id ?>">Detalles</a>
    </div>