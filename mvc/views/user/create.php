<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nuevo usuario <?= APP_NAME ?></title>
    <?= $template->css() ?>
    <script src="/js/Preview.js"></script>
</head>

<body>
    <?= $template->login() ?>
    <?= $template->header('Nuevo usuario') ?>
    <?= $template->menu() ?>
    <?= $template->breadCrumbs([
        'Temas' => null
    ]) ?>
    <?= $template->messages() ?>
    <main>
        <h1>Nuevo usuario en <?= APP_NAME ?></h1>

        <section id="new-user">
            <h2>Nuevo usuario</h2>

            <div class="flex-container">
                <form method="POST" action="/User/store"
                      enctype="multipart/form-data" class="flex2 no-border">
                    
                    <label>Nombre</label>
                    <input type="text" name="displayname">
                    <br>
                    <label>Email</label>
                    <input type="email" name="email" id="inputEmail">
                    <span id="comprobacion" class="info"></span>
                    <br>
                    <label>Phone</label>
                    <input type="text" name="phone">
                    <br>
                    <label>Password</label>
                    <input type="password" name="password">
                    <br>
                    <label>Repite password</label>
                    <input type="password" name="repeatpassword">
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
                        <?php foreach(USER_ROLES as $roleName => $roleValue){ ?>
                            <option value="<?= $roleValue ?>"><?= $roleName ?></option>
                        <?php } ?>
                    </select>
                    <div class="centered mt3">
                        <input type="submit" class="button" name="guardar" value="Guardar">
                        <input type="reset" class="button" value="Reset">
                    </div>  
                </form>
                <figure class="flex1 centrado">
                    <img src="<?= USER_IMAGE_FOLDER.'/'.DEFAULT_USER_IMAGE ?>"
                    id="preview-image" class="cover" alt="Previsualización de la imagen de perfil">
                    <figcaption>Previsualización de la imagen de perfil</figcaption>
                </figure>
            </div>
        </section>