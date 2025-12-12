<?php
class Usuario
{
    /*static public function listarRespuestaPregunta($tabla, $columna, $valor)
    {
        $respuesta = RespuestaModel::listar($tabla, $columna, $valor);
        return $respuesta;
    }*/

    public function registroUsuario()
    {
        //var_dump($_POST);
        if (isset($_POST['nombre']) && isset($_POST['paterno']) && isset($_POST['materno']) && isset($_POST['correo']) && isset($_POST['clave']) && isset($_POST['repita_clave'])) {
            if ($_POST['clave'] === $_POST['repita_clave']) {
                if (self::validarEntrada($_POST['nombre']) && self::validarEntrada($_POST['paterno']) && self::validarEntrada($_POST['materno'])) {
                    $datos = array(
                        'nombre' => trim($_POST['nombre']),
                        'paterno' => trim($_POST['paterno']),
                        'materno' => trim($_POST['materno'])
                    );

                    $id_persona = UsuarioModel::registroPersona("persona", $datos);
                    /*var_dump($id_persona);
                    exit;*/

                    if ($id_persona) {
                        $datos = array(
                            'id_usuario' => $id_persona,
                            'usuario' => trim($_POST['correo']),
                            'clave' => password_hash(trim($_POST['clave']), PASSWORD_DEFAULT),
                            'rol' => 'USUARIO'
                        );

                        $respuesta = UsuarioModel::registroUsuario("usuario", $datos);
                        if ($respuesta) {
                            /*var_dump($respuesta);
                            exit;*/
                            $persona = UsuarioModel::obtenerPersona($id_persona);
                            self::iniciarSesion($persona);
                        }
                    }
                } else {
                    echo "<div class='alert alert-danger mt-2' role='alert'>
                    Datos inválidos los campos solo pueden contener letra y espacios
                    </div>";
                }
            } else {
                echo "<div class='alert alert-danger mt-2' role='alert'>
                Las contraseñas no coinciden
                </div>";
            }
        }
    }

    static private function validarEntrada($input)
    {
        return preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $input);
    }

    static private function iniciarSesion($persona)
    {
        $_SESSION['id'] = $persona['id_persona'];
        $_SESSION['nombre'] = $persona['nombre'];
        $_SESSION['paterno'] = $persona['paterno'];
        $_SESSION['materno'] = $persona['materno'];
        $_SESSION['usuario'] = $persona['usuario'];
        $_SESSION['rol'] = $persona['rol'];
        echo '<script>
            window.location="' . BASE_URL . '";
        </script>';
    }
    static public function loginUsuario()
    {
        if (isset($_POST['usuario']) && isset($_POST['clave'])) {
            $usuario = UsuarioModel::obtenerPersonaPorUsuario($_POST['usuario']);
            if ($usuario) {
                if (password_verify($_POST['clave'], $usuario['clave'])) {
                    self::iniciarSesion($usuario);
                } else {
                    echo "<div class='alert alert-danger mt-2' role='alert'>
                    Contraseña incorrecta
                    </div>";
                }
            } else {
                echo "<div class='alert alert-danger mt-2' role='alert'>
                Usuario no encontrado
                </div>";
            }
        }
    }
}
