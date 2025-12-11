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
                    $tabla_persona = "persona";
                    $tabla_usuario = "usuario";

                    $registro = UsuarioModel::registroUsuario($tabla_persona, $tabla_usuario, $datos);
                    if ($registro == "ok") {
                        echo "<div class='alert alert-success'>Registro exitoso</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error en el registro</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Datos inválidos</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Las contraseñas no coinciden</div>";
            }
        }
    }

    static private function validarEntrada($input)
    {
        return preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $input);
    }
}
