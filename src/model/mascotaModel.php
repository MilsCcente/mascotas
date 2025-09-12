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


    // Obtener un perrito por ID
    public function obtenerPerrito($id) {
        $sql = "SELECT * FROM perritos WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    // Editar perrito
public function editarPerrito($id, $nombre, $raza, $edad, $peso, $color, $genero, $vacunado) {
    // Asegurar que genero llegue limpio (sin espacios extra)
    $genero = trim($genero);

    $sql = "UPDATE perritos 
            SET nombre = ?, raza = ?, edad = ?, peso = ?, color = ?, genero = ?, vacunado = ?
            WHERE id = ?";

    $stmt = $this->conexion->prepare($sql);

    /*
      Tipos:
      s = string (nombre, raza, color, genero)
      i = entero (edad, vacunado, id)
      d = decimal/float (peso)
    */

    $stmt->bind_param("sssdssii", 
        $nombre,   // string
        $raza,     // string
        $edad,     // int
        $peso,     // double/float
        $color,    // string
        $genero,   // string (ENUM)
        $vacunado, // int (0 o 1)
        $id        // int
    );

    return $stmt->execute();
}


    // Eliminar perrito
    public function eliminarPerrito($id) {
        $sql = "DELETE FROM perritos WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

