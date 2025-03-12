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
    <main>
        <section>
            <h1>Recuperación de password</h1>
            <p>Rellena este formulario para recibir una nueva clave en tu email con la que podrás acceder a la aplicación. Recuerda que debes cambiarla lo antes posible</p>
            <form action="/Forgotpassword/send" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value=" <?= $user->id ?>" >
                <input type="email" name="email">
                <input type="number" name="phone">
                <button type="submit" class="button" name="nueva" value="Nueva clave"></button>
                <a href="/Login">Volver a login</a>
            </form>
        </section>