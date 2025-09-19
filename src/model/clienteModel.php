<?php
require_once "../library/conexion.php";

class ClienteModel {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::connect();
    }

    public function getClientes() {
        $sql = "SELECT * FROM cliente ORDER BY id DESC";
        $res = $this->conexion->query($sql);
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getCliente($id) {
        $sql = "SELECT * FROM cliente WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insertarCliente($dni, $nombre, $telefono, $correo) {
        $sql = "INSERT INTO cliente (dni, nombre_apellidos, telefono, correo, estado) 
                VALUES (?, ?, ?, ?, 'activo')";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("isss", $dni, $nombre, $telefono, $correo);
        return $stmt->execute();
    }

    public function actualizarCliente($id, $dni, $nombre, $telefono, $correo, $estado) {
        $sql = "UPDATE cliente SET dni=?, nombre_apellidos=?, telefono=?, correo=?, estado=? WHERE id=?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("issssi", $dni, $nombre, $telefono, $correo, $estado, $id);
        return $stmt->execute();
    }

    public function eliminarCliente($id) {
        $sql = "DELETE FROM cliente WHERE id=?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
