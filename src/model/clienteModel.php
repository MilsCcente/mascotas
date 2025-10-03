<?php
require_once '../library/conexion.php'; // conexión a la BD

class ClienteModel {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::connect();
    }

    public function obtenerClientes() {
        $arrRespuesta = array();
        $respuesta = $this->conexion->query("SELECT * FROM cliente_api");
        while ($objeto = $respuesta->fetch_object()) {
            array_push($arrRespuesta, $objeto);
        }
        return $arrRespuesta;
    }




    // 📌 2. Registrar un cliente
    public function registrarCliente($dni, $nombre, $telefono, $correo, $estado) {
        $sql = "INSERT INTO cliente_api (dni, nombre_apellidos, telefono, correo, estado)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);

        /*
          Tipos:
          s = string (dni, nombre, telefono, correo, estado)
        */
        $stmt->bind_param("sssss", $dni, $nombre, $telefono, $correo, $estado);

        if ($stmt->execute()) {
            return ['id' => $stmt->insert_id]; // devuelve el ID insertado
        } else {
            return ['id' => 0];
        }
    }

    // 📌 3. Obtener un cliente por ID
    public function obtenerCliente($id) {
        $sql = "SELECT * FROM cliente_api WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    // 📌 4. Editar cliente
    public function editarCliente($id, $dni, $nombre, $telefono, $correo, $estado) {
        $sql = "UPDATE cliente_api 
                SET dni = ?, nombre_apellidos = ?, telefono = ?, correo = ?, estado = ?
                WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);

        $stmt->bind_param("sssssi", 
            $dni, 
            $nombre, 
            $telefono, 
            $correo, 
            $estado, 
            $id
        );

        return $stmt->execute();
    }

    // 📌 5. Eliminar cliente
    public function eliminarCliente($id) {
        $sql = "DELETE FROM cliente_api WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
