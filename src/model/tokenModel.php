<?php
require_once '../library/conexion.php';

class TokenModel {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::connect(); // conexión mysqli
    }

    /* === LISTAR TOKENS === */
    public function obtener_tokens() {
        $arrRespuesta = array();
        $sql = "SELECT t.id, t.id_cliente_api, t.token, t.fecha_registro, t.estado, c.nombre as cliente 
                FROM tokens t
                INNER JOIN clientes c ON t.id_cliente_api = c.id";
        $respuesta = $this->conexion->query($sql);

        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }

        return $arrRespuesta;
    }

    /* === REGISTRAR TOKEN === */
    public function registrarToken($id_cliente_api, $token, $estado) {
        $sql = "INSERT INTO tokens (id_cliente_api, token, fecha_registro, estado)
                VALUES (?, ?, NOW(), ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("iss", $id_cliente_api, $token, $estado);

        if ($stmt->execute()) {
            return ['id' => $stmt->insert_id];
        } else {
            return ['id' => 0];
        }
        
    }

    /* === OBTENER TOKEN POR ID === */
    public function obtenerToken($id) {
        $sql = "SELECT * FROM tokens WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    /* === EDITAR TOKEN === */
    public function editarToken($id, $id_cliente_api, $token, $estado) {
        $sql = "UPDATE tokens 
                SET id_cliente_api = ?, token = ?, estado = ?
                WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("issi", $id_cliente_api, $token, $estado, $id);

        return $stmt->execute();
    }

    /* === ELIMINAR TOKEN === */
    public function eliminarToken($id) {
        $sql = "DELETE FROM tokens WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
