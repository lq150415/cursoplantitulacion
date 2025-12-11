<?php
class Respuesta
{
    static public function listarRespuestaPregunta($tabla, $columna, $valor)
    {
        $respuesta = RespuestaModel::listar($tabla, $columna, $valor);
        return $respuesta;
    }

    public function guardarRespuesta()
    {
        //var_dump($_POST,$_FILES);
        if (isset($_POST['descripcion'])) {
            $descripcion = trim($_POST['descripcion']);

            if (self::validarEntrada($descripcion) && self::validarImagen($_FILES['foto']['type'])) {
                $ruta = NULL;
                if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != "") {
                    $directorio = "vistas/upload/respuesta/";
                    $ruta = $directorio . time() . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
                }
                $datos = array(
                    'descripcion' => $descripcion,
                    'foto' => $ruta,
                    'id_pregunta' => $_POST['id_pregunta'],
                    'id_usuario' => 1
                );
                $respuesta = RespuestaModel::guardarRespuesta('respuesta', $datos);
                $rut = trim(BASE_URL . "respuesta/" . $_POST['id_pregunta']);
                if ($respuesta) {
                    echo "<script>
                        alert('La respuesta ha sido guardada exitosamente.');
                        window.location='" . $rut . "';
                    </script>";
                } else {
                    echo "<script>
                        alert('Error al guardar la respuesta. Por favor, inténtelo de nuevo.');
                    </script>";
                }
            } else {
                echo "<script>
                    alert('Error: Entrada inválida. Solo se permiten letras, números y algunos caracteres especiales.');
                </script>";
            }
        }
    }

    static private function validarEntrada($input)
    {
        return preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓ¡Ú¿?!,. ]+$/', $input);
    }

    static private function validarImagen($tipo)
    {
        if ($tipo != "") {
            return $tipo == 'image/jpeg' || $tipo == 'image/png' || $tipo == 'image/jpg';
        } else {
            return true;
        }
    }
}
