<?php
class Pregunta
{
    static public function listarPreguntas($tabla, $columna, $valor)
    {
        $respuesta = PreguntaModel::listar($tabla, $columna, $valor);
        return $respuesta;
    }

    public function guardarPregunta()
    {
        //var_dump($_POST,$_FILES);
        if (isset($_POST['titulo']) && isset($_POST['descripcion'])) {
            $titulo = trim($_POST['titulo']);
            $descripcion = trim($_POST['descripcion']);

            if (self::validarEntrada($titulo) && self::validarEntrada($descripcion) && self::validarImagen($_FILES['foto']['type'])) {
                $directorio = "vistas/upload/pregunta/";
                $archivo = $directorio . time() . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $archivo)) {
                    $datos = array(
                        'titulo' => $titulo,
                        'descripcion' => $descripcion,
                        'foto' => $archivo,
                        'id_usuario' => $_SESSION['id']
                    );
                    $respuesta = PreguntaModel::guardarPregunta('pregunta', $datos);
                    if ($respuesta) {
                        echo "<script>
                            alert('La pregunta ha sido guardada exitosamente.');
                            window.location='preguntas';
                        </script>";
                    } else {
                        echo "<script>
                            alert('Error al guardar la pregunta. Por favor, inténtelo de nuevo.');
                        </script>";
                    }
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
        return $tipo == 'image/jpeg' || $tipo == 'image/png' || $tipo == 'image/jpg';
    }

    static public function listarPreguntasUsuario($tabla, $columna, $valor)
    {
        $preguntas = PreguntaModel::listarPreguntasUsuario('pregunta', 'id_usuario', $_SESSION['id']);
        return $preguntas;
    }
}
