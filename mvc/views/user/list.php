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
    <div class="right">
                <?= $paginator->stats() ?>
            </div>
        <table class="table w100">
            <tr>
                <th>Foto de perfil</th>
                <th>Nombre de usuarios</th>
                <th>Telefono</th>
                <th>Rol</th>
                <th>Operaciones</th>
            </tr>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><img class="table-image" src="<?= USER_IMAGE_FOLDER.'/'.$user->picture ?>" alt=""></td>
                    <td><?= $user->displayname ?></td>
                    <td><?= $user->phone ?></td>
                    <td><?= $user->roles ?></td>
                    <td class="centrado">
                      <a class="button" href="/User/show/<?= $user->id ?>">Ver detalles</a>
                      <a class="button" href="/User/edit/<?= $user->id ?>">Editar usuario</a>
                      <?php if(!$tema->ejemplares){ ?>
                      <a class="button" href="/User/delete/<?= $user->id ?>">Borrar usuario</a>
                      <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>