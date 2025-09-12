<?php
require_once '../library/conexion.php';

class UsuarioModel {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::connect(); // Conexión mysqli
    }

    // Obtener todos los usuarios
    public function obtener_usuarios() {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM usuarios");
        
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }

        return $arrRespuesta;
    }

// Registrar usuario
public function registrarUsuario($nombre, $password, $rol) {
    $sql = "INSERT INTO usuarios (nombre, contraseña, rol)
            VALUES (?, ?, ?)";
    
    $stmt = $this->conexion->prepare($sql);
    $stmt->bind_param("sss", $nombre, $password, $rol);

    if ($stmt->execute()) {
        return ['id' => $stmt->insert_id];
    } else {
        return ['id' => 0];
    }
}


    // Obtener un usuario por ID
    public function obtenerUsuario($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

  // Editar usuario (sin modificar contraseña)
public function editarUsuario($id, $nombre, $rol) {
    $sql = "UPDATE usuarios SET nombre = ?, rol = ? WHERE id = ?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $rol, $id);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}



    // Eliminar usuario
    public function eliminarUsuario($id) {
        $sql = "DELETE FROM usuario WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
