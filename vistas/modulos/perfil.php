<?php
require_once __DIR__ . "/../../modelos/UsuarioModel.php";
//$preguntas = Pregunta::listarPreguntas('pregunta', 'id_usuario', $_SESSION['id']);
$preguntas = Pregunta::listarPreguntasUsuario('pregunta', 'id_usuario', $_SESSION['id']);
//var_dump($preguntas);
$usuario = UsuarioModel::obtenerPersona($_SESSION['id']);
$avatar = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : $usuario['avatar'];
$avatar_url = $avatar ? BASE_URL . $avatar : BASE_URL . 'vistas/dist/images/user.png';
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Perfil<small></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Inicio</a></li>
                        <li class="breadcrumb-item">Perfil</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="<?= $avatar_url ?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"> <?= $_SESSION['nombre'] . ' ' . $_SESSION['paterno'] . ' ' . $_SESSION['materno'] ?></h3>

                        <p class="text-muted text-center"><?= $_SESSION['usuario'] ?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Preguntas</b> <a class="float-right"><?= (count($preguntas) + 1) ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Respuestas</b> <a class="float-right">5</a>
                            </li>
                        </ul>

                        <a href="<?= BASE_URL ?>editar_perfil" class="btn btn-primary btn-block"><b>Editar</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class=" p-2 d-flex justify-content-between">

                        <h2>Preguntas Posteadas</h2>
                        <a href="<?= BASE_URL ?>pregunta" class="btn btn-primary ">Formular Pregunta</a>
                    </div>
                    <hr>
                    <div class="card-body">
                        <?php if (count($preguntas) > 0): ?>
                            <?php foreach ($preguntas as $pregunta): ?>
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="<?= BASE_URL ?>vistas/dist/images/user.png" alt="user image">
                                        <span class="username">
                                            <a href="<?= BASE_URL?>/respuesta/<?= $pregunta['id_pregunta'] ?>"><?= $pregunta['titulo'] ?></a>
                                        </span>
                                        <span class="description">Publicado el - <?= $pregunta['creado_el'] ?></span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        <?= $pregunta['descripcion'] ?>
                                    </p>

                                    <p>
                                        <a href="#" class="link-black text-sm">
                                            <i class="far fa-comments mr-1"></i> Respuestas (<?= $pregunta['cantidad_respuestas'] ?>)
                                        </a>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- mensaje sinpreguntas -->
                            <div class="post">
                                <p>Sin Preguntas Posteadas</p>
                            </div>
                        <?php endif; ?>
                        <!-- mensaje sinpreguntas -->
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</div>