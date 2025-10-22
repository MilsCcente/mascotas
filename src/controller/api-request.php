<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

require_once('../model/apiModel.php');
$tipo = $_GET['tipo'];

// Instanciar la clase del modelo
$objApi = new ApiModel();

// Variables recibidas
$token = $_POST['token'] ?? '';

if ($tipo == "verPerritosApiByNombre") {

    // Separar token
    $token_arr = explode("-", $token);
    $id_cliente = $token_arr[2] ?? 0;

    // Buscar cliente
    $arr_Cliente = $objApi->buscarClienteById($id_cliente);

    if ($arr_Cliente && $arr_Cliente->estado) {
        // Capturar valores del formulario
        $data = $_POST['data'] ?? '';
        $raza = $_POST['raza'] ?? '';
        $genero = $_POST['genero'] ?? '';

        // Buscar perritos según filtros
        $arr_perritos = $objApi->buscarPerritoPorNombreYFiltro($data, $raza, $genero);

        // Respuesta exitosa
        $arr_Respuesta = array(
            'status' => true,
            'msg' => '',
            'contenido' => $arr_perritos
        );

    } else {
        // Cliente no válido
        $arr_Respuesta = array(
            'status' => false,
            'msg' => 'Error, cliente no activo o no encontrado.'
        );
    }

    echo json_encode($arr_Respuesta);
}
?>
