<?php
require_once '../library/conexion.php';

class MascotaModel {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::connect(); // Obtenemos la conexión mysqli
    }

     public function obtener_perritos() {
    $arrRespuesta = array();
    $respuesta = $this->conexion->query("SELECT * FROM perritos");
    
    while ($objeto = $respuesta->fetch_object()) {
        array_push($arrRespuesta, $objeto);
    }

    return $arrRespuesta;
}

    public function registrarPerrito($nombre, $raza, $edad, $peso, $color, $genero, $vacunado) {
    $sql = $sql = "INSERT INTO perritos (nombre, raza, edad, peso, color, genero, vacunado)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $this->conexion->prepare($sql);
$stmt->bind_param("ssidssi", $nombre, $raza, $edad, $peso, $color, $genero, $vacunado);


    if ($stmt->execute()) {
        return ['id' => $stmt->insert_id]; // devuelve el ID insertado
    } else {
        return ['id' => 0];
    }
}

}
