<?php
require_once('../model/tokenModel.php');

$tipo = $_REQUEST['tipo'];

$objToken = new TokenModel();

/* === LISTAR TOKENS === */
if ($tipo == "listar") {
    $arr_Respuestas = array('status' => false, 'contenido' => '');
    $arr_tokens = $objToken->obtener_tokens(); // Método que obtiene todos los tokens

    if (!empty($arr_tokens)) {
        for ($i = 0; $i < count($arr_tokens); $i++) {
            $id_token = $arr_tokens[$i]->id_cliente_api;

            // Botones de acción
            $opciones = '
            <div class="d-flex justify-content-start gap-2">
                <a href="' . BASE_URL . 'editar-token/' . $id_token . '" class="btn btn-warning btn-sm d-inline-flex align-items-center">
                    <i class="fa fa-pencil"></i> Editar
                </a>
                <button onclick="eliminar_token(' . $id_token . ');" class="btn btn-danger btn-sm d-inline-flex align-items-center">
                    <i class="fa fa-trash"></i> Eliminar
                </button>
            </div>';

            $arr_tokens[$i]->options = $opciones;
        }

        $arr_Respuestas['status'] = true;
        $arr_Respuestas['contenido'] = $arr_tokens;
    }

    echo json_encode($arr_Respuestas);
}

/* === REGISTRAR TOKEN === */
if ($tipo == "registrar") {
    if ($_POST) {
        $token   = $_POST['token'];
        $estado  = $_POST['estado'];

        if ($token == "" || $estado == "") {
            $arr_Respuestas = array('status' => false, 'mensaje' => 'Error, los campos Token y Estado son obligatorios');
        } else {
            // Llamada al modelo para registrar
            $arrToken = $objToken->registrarToken($token, $estado);

            if ($arrToken['id'] > 0) {
                $arr_Respuestas = array('status' => true, 'mensaje' => 'Token registrado con éxito');
            } else {
                $arr_Respuestas = array('status' => false, 'mensaje' => 'Error al registrar token');
            }
        }

        echo json_encode($arr_Respuestas);
    }
}

/* === EDITAR TOKEN === */
if ($tipo == "editar") {
    if ($_POST) {
        $id      = $_POST['id'];
        $token   = $_POST['token'];
        $estado  = $_POST['estado'];

        if ($id == "" || $token == "" || $estado == "") {
            $arr_Respuestas = array('status' => false, 'mensaje' => 'Error, campos vacíos');
        } else {
            $editado = $objToken->editarToken($id, $token, $estado);

            if ($editado) {
                $arr_Respuestas = array('status' => true, 'mensaje' => 'Token actualizado con éxito');
            } else {
                $arr_Respuestas = array('status' => false, 'mensaje' => 'Error al actualizar token');
            }
        }
        echo json_encode($arr_Respuestas);
    }
}

/* === VER TOKEN (precargar form) === */
if ($tipo == "ver") {
    if ($_POST) {
        $id = $_POST['id'];
        $tokenData = $objToken->obtenerToken($id);

        if ($tokenData) {
            $arr_Respuestas = array('status' => true, 'contenido' => $tokenData);
        } else {
            $arr_Respuestas = array('status' => false, 'mensaje' => 'Token no encontrado');
        }
        echo json_encode($arr_Respuestas);
    }
}

/* === ELIMINAR TOKEN === */
if ($tipo == "eliminar") {
    $id = $_POST['id'];
    
    try {
        $arr_Respuesta = $objToken->eliminarToken($id);
        
        if ($arr_Respuesta) {
            $response = array(
                'status' => true,
                'message' => 'Token eliminado correctamente.'
            );
        } else {
            $response = array(
                'status' => false,
                'message' => 'No se encontró el token o no pudo ser eliminado.'
            );
        }
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            $response = array(
                'status' => false,
                'message' => 'No se puede eliminar este token porque está asociado a otros registros.'
            );
        } else {
            $response = array(
                'status' => false,
                'message' => 'Ocurrió un error inesperado: ' . $e->getMessage()
            );
        }
    }

    echo json_encode($response);
}
