<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

require_once('../model/apiModel.php');

$tipo = $_GET['tipo'] ?? '';

$objApi = new ApiModel();

$token = $_POST['token'] ?? '';

if ($tipo == "verPerritosApiByNombre") {
    $verificacion = $objApi->verificarToken($token);

    if (!$verificacion['estado']) {
        $arr_Respuesta = array(
            'status' => false,
            'msg' => $verificacion['mensaje'],
            'contenido' => []
        );
        echo json_encode($arr_Respuesta);
        exit;
    }
    $token_arr = explode("-", $token);
    $id_cliente = $token_arr[2] ?? 0;

    $arr_Cliente = $objApi->buscarClienteById($id_cliente);

    if ($arr_Cliente && $arr_Cliente->estado == 1) {

        $data = $_POST['data'] ?? '';
        $raza = $_POST['raza'] ?? '';
        $genero = $_POST['genero'] ?? '';

        $arr_perritos = $objApi->buscarPerritoPorNombreYFiltro($data, $raza, $genero);

        if (!empty($arr_perritos)) {
            $arr_Respuesta = array(
                'status' => true,
                'msg' => '',
                'contenido' => $arr_perritos
            );
        } else {
            $arr_Respuesta = array(
                'status' => false,
                'msg' => 'No se encontraron perritos.',
                'contenido' => []
            );
        }

    } else {
        $arr_Respuesta = array(
            'status' => false,
            'msg' => 'Error, cliente no activo o no encontrado.',
            'contenido' => []
        );
    }
    echo json_encode($arr_Respuesta);
}
?>
