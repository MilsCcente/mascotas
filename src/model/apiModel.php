<?php
require_once "../library/conexion.php";

class ApiModel
{
    private $conexion;

    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    // Buscar cliente según ID (verifica el token)
    public function buscarClienteById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM cliente_api WHERE id='$id'");
        $sql = $sql->fetch_object();
        return $sql;
    }

    // 🔍 Buscar perritos por nombre, raza y género
    public function buscarPerritoPorNombreYFiltro($nombre, $raza, $genero)
    {
        $sql = "SELECT * FROM perritos WHERE nombre LIKE '%$nombre%'";

        if (!empty($raza)) {
            $sql .= " AND raza = '$raza'";
        }

        if (!empty($genero)) {
            $sql .= " AND genero = '$genero'";
        }

        $resultado = $this->conexion->query($sql);

        $perritos = [];
        while ($row = $resultado->fetch_assoc()) {
            $perritos[] = $row;
        }

        return $perritos;
    }
}
?>
