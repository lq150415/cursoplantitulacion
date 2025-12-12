<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Editar Perfil <small></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>perfil">Perfil</a></li>
                        <li class="breadcrumb-item">Editar</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Nombre" value="<?= $_SESSION['nombre'] ?>" required />
                                </div>
                                <div class="form-group">
                                    <label for="paterno">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="paterno" name="paterno"
                                        placeholder="Apellido Paterno" value="<?= $_SESSION['paterno'] ?>" required />
                                </div>
                                <div class="form-group">
                                    <label for="materno">Apellido Materno</label>
                                    <input type="text" class="form-control" id="materno" name="materno"
                                        placeholder="Apellido Materno" value="<?= $_SESSION['materno'] ?>" />
                                </div>

                                <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="avatar" name="avatar"
                                                accept="image/png, image/jpg, image/jpeg" />
                                            <label class="custom-file-label" for="avatar">Seleccionar imagen</label>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Opcional. Solo imágenes JPG, PNG.</small>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                                    Guardar Cambios
                                </button>
                                <a href="<?= BASE_URL ?>perfil" class="btn btn-secondary">Cancelar</a>
                            </div>
                            <?php
                            require_once "../../modelos/UsuarioModel.php";
                                $usuario=new Usuario();
                                $usuario->editarPerfil();
                            ?>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title m-0">Información</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                Actualiza tu información personal. La imagen de avatar es opcional.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>