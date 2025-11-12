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

    public function buscarClienteById($id)
    {
        $sql = $this->conexion->query("SELECT * FROM cliente_api WHERE id='$id'");
        return $sql->fetch_object();
    }

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
            // ✅ Convierte 1 → Sí, 0 → No
            $row['vacunado'] = ($row['vacunado'] == 1) ? 'Sí' : 'No';
            $perritos[] = $row;
        }

        return $perritos;
    }

    public function verificarToken($token)
    {
        // Trim para evitar espacios invisibles
        $token = trim($token);
    
        // Buscar token en la base de datos
        $sql = $this->conexion->query("SELECT * FROM tokens WHERE token = '{$this->conexion->real_escape_string($token)}' LIMIT 1");
        $tokenData = $sql->fetch_object();
    
        if (!$tokenData) {
            return [
                'estado' => false,
                'mensaje' => 'Token no encontrado'
            ];
        }
    
        if ($tokenData->estado == 0) {
            return [
                'estado' => false,
                'mensaje' => 'Token inactivo'
            ];
        }
    
        $fechaToken = strtotime($tokenData->fecha_registro);
        $ahora = time();
        $diferenciaDias = ($ahora - $fechaToken) / (3600 * 24);
        if ($diferenciaDias > 30) {
            return [
                'estado' => false,
                'mensaje' => 'Token vencido (más de 30 días), pida una renovación'
            ];
        }
    
        // Retornar también el id del cliente que está guardado en la tabla tokens
        return [
            'estado' => true,
            'mensaje' => 'Token válido',
            'tokenData' => $tokenData // objeto completo con id_cliente_api, token, fecha_registro...
        ];
    }
    
}
?>
