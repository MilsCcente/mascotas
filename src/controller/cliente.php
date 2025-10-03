<?php
require_once('../model/ClienteModel.php'); // Importamos el modelo

$tipo = $_REQUEST['tipo'];
$objCliente = new ClienteModel();

/* === LISTAR CLIENTES === */
if ($tipo == "listar") {
    $arr_Respuestas = array('status' => false, 'contenido' => []);
    $arr_clientes = $objCliente->obtenerClientes();

    if (!empty($arr_clientes)) {
        $arr_Respuestas['status'] = true;
        $arr_Respuestas['contenido'] = $arr_clientes;
    }

    // Se asegura de enviar JSON correcto
    header('Content-Type: application/json');
    echo json_encode($arr_Respuestas);
    exit;
}

/* === REGISTRAR CLIENTE === */
if ($tipo == "registrar" && $_POST) {
    $dni      = $_POST['dni'] ?? '';
    $nombre   = $_POST['nombre_apellidos'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $correo   = $_POST['correo'] ?? '';
    $estado   = $_POST['estado'] ?? '';

    if ($dni === "" || $nombre === "") {
        $arr_Respuestas = array('status' => false, 'mensaje' => 'Error, los campos DNI y Nombre son obligatorios');
    } else {
        $arrCliente = $objCliente->registrarCliente($dni, $nombre, $telefono, $correo, $estado);

        if ($arrCliente['id'] > 0) {
            $arr_Respuestas = array('status' => true, 'mensaje' => 'Cliente registrado con éxito');
        } else {
            $arr_Respuestas = array('status' => false, 'mensaje' => 'Error al registrar cliente');
        }
    }

    header('Content-Type: application/json');
    echo json_encode($arr_Respuestas);
    exit;
}

/* === EDITAR CLIENTE === */
if ($tipo == "editar" && $_POST) {
    $id       = $_POST['id'] ?? '';
    $dni      = $_POST['dni'] ?? '';
    $nombre   = $_POST['nombre_apellidos'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $correo   = $_POST['correo'] ?? '';
    $estado   = $_POST['estado'] ?? '';

    if ($id === "" || $dni === "" || $nombre === "") {
        $arr_Respuestas = array('status' => false, 'mensaje' => 'Error, campos obligatorios vacíos');
    } else {
        $editado = $objCliente->editarCliente($id, $dni, $nombre, $telefono, $correo, $estado);
        if ($editado) {
            $arr_Respuestas = array('status' => true, 'mensaje' => 'Cliente actualizado con éxito');
        } else {
            $arr_Respuestas = array('status' => false, 'mensaje' => 'Error al actualizar cliente');
        }
    }

    header('Content-Type: application/json');
    echo json_encode($arr_Respuestas);
    exit;
}

/* === VER CLIENTE === */
if ($tipo == "ver" && $_POST) {
    $id = $_POST['id'] ?? '';
    $cliente = $objCliente->obtenerCliente($id);

    if ($cliente) {
        $arr_Respuestas = array('status' => true, 'contenido' => $cliente);
    } else {
        $arr_Respuestas = array('status' => false, 'mensaje' => 'Cliente no encontrado');
    }

    header('Content-Type: application/json');
    echo json_encode($arr_Respuestas);
    exit;
}

/* === ELIMINAR CLIENTE === */
if ($tipo == "eliminar" && $_POST) {
    $id = $_POST['id'] ?? '';

    try {
        $arr_Respuesta = $objCliente->eliminarCliente($id);
        $response = array(
            'status' => $arr_Respuesta ? true : false,
            'message' => $arr_Respuesta ? 'Cliente eliminado correctamente.' : 'No se encontró el cliente o no pudo ser eliminado.'
        );
    } catch (PDOException $e) {
        $response = array(
            'status' => false,
            'message' => 'Error: ' . $e->getMessage()
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
