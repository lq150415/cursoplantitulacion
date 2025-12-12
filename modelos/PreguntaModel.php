<?php
    require_once"Conexion.php";

    class PreguntaModel{
        static public function listar($tabla,$columna,$valor){
            if($columna==NULL){
                $stmt=Conexion::conectar()->prepare("SELECT p.*,CONCAT_WS(' ',pe.nombre,pe.paterno,pe.materno) as usuario 
                FROM $tabla p JOIN usuario u ON p.id_usuario=u.id_usuario inner join persona pe ON u.id_usuario=pe.id_persona");
                $stmt->execute();
                return $stmt->fetchAll();
            }else{
                $stmt=Conexion::conectar()->prepare("SELECT p.*,CONCAT_WS(' ',pe.nombre,pe.paterno,pe.materno) as usuario 
                FROM $tabla p JOIN usuario u ON p.id_usuario=u.id_usuario inner join persona pe ON u.id_usuario=pe.id_persona 
                WHERE p.$columna=:$columna");
                $stmt->bindParam(":".$columna,$valor,PDO::PARAM_INT);
                $stmt->execute();
                if($columna=="id_usuario"){
                    return $stmt->fetchAll();//devuelve varias preguntas
                }
                return $stmt->fetch();//devuelve una sola pregunta
            }
        }

        static public function guardarPregunta($tabla,$datos){
            $stmt=Conexion::conectar()->prepare("INSERT INTO $tabla(titulo,descripcion,foto,id_usuario) VALUES(:titulo,:descripcion,:foto,:id_usuario)");
            $stmt->bindParam(":titulo",$datos['titulo'],PDO::PARAM_STR);
            $stmt->bindParam(":descripcion",$datos['descripcion'],PDO::PARAM_STR);
            $stmt->bindParam(":foto",$datos['foto'],PDO::PARAM_STR);
            $stmt->bindParam(":id_usuario",$datos['id_usuario'],PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

        static public function listarPreguntasUsuario($tabla,$columna,$valor){
            $stmt=Conexion::conectar()->prepare("SELECT p.*,(SELECT COUNT(*) FROM respuesta r 
                                    WHERE r.id_pregunta=p.id_pregunta) AS cantidad_respuestas
                                    FROM $tabla p WHERE p.$columna=:$columna");
            $stmt->bindParam(":".$columna,$valor,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();//
        }
    }
?>