<?php
    require_once"Conexion.php";

    class UsuarioModel{
        /*static public function listar($tabla,$columna,$valor){         
                $stmt=Conexion::conectar()->prepare("SELECT r.*,CONCAT_WS(' ',pe.nombre,pe.paterno,pe.materno) as usuario FROM $tabla r JOIN usuario u ON r.id_usuario=u.id_usuario inner join persona pe ON u.id_usuario=pe.id_persona WHERE $columna=:$columna");
                $stmt->bindParam(":".$columna,$valor,PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetchAll();
            
        }*/

        static public function registroPersona($tabla,$datos){
            $stmt=Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion,foto,id_usuario,id_pregunta) VALUES(:descripcion,:foto,:id_usuario,:id_pregunta)");
            $stmt->bindParam(":descripcion",$datos['descripcion'],PDO::PARAM_STR);
            $stmt->bindParam(":foto",$datos['foto'],PDO::PARAM_STR);
            $stmt->bindParam(":id_usuario",$datos['id_usuario'],PDO::PARAM_INT);
            $stmt->bindParam(":id_pregunta",$datos['id_pregunta'],PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }
        static public function registroUsuario($tabla,$datos){
            $stmt=Conexion::conectar()->prepare("INSERT INTO $tabla(usuario,clave,id_usuario) VALUES(:usuario,:clave,:id_usuario)");
            $stmt->bindParam(":usuario",$datos['usuario'],PDO::PARAM_STR);
            $stmt->bindParam(":clave",$datos['clave'],PDO::PARAM_STR);
            $stmt->bindParam(":id_usuario",$datos['id_usuario'],PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }
    }
?>