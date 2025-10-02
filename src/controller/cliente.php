<?php
require_once('../model/ClienteModel.php'); // Importamos el modelo correcto

$tipo = $_REQUEST['tipo'];

$objCliente = new ClienteModel();

/* === LISTAR CLIENTES === */
if ($tipo == "listar") {
    $arr_Respuestas = array('status' => false, 'contenido' => '');
    $arr_clientes = $objCliente->obtenerClientes(); // Método que obtiene todos los clientes

    if (!empty($arr_clientes)) {
        for ($i = 0; $i < count($arr_clientes); $i++) {
            $id_cliente = $arr_clientes[$i]->id;

            // Botones de acción
            $opciones = '
            <div class="d-flex justify-content-start gap-2">
                <a href="' . BASE_URL . 'editar-cliente/'. $id_cliente . '" class="btn btn-warning btn-sm d-inline-flex align-items-center">
                    <i class="fa fa-pencil"></i> Editar
                </a>
                <button onclick="eliminar_cliente(' . $id_cliente . ');" class="btn btn-danger btn-sm d-inline-flex align-items-center">
                    <i class="fa fa-trash"></i> Eliminar
                </button>
            </div>';

            $arr_clientes[$i]->options = $opciones;
        }

        $arr_Respuestas['status'] = true;
        $arr_Respuestas['contenido'] = $arr_clientes;
    }

    echo json_encode($arr_Respuestas);
}

/* === REGISTRAR CLIENTE === */
if ($tipo == "registrar") {
    if ($_POST) {
        $dni      = $_POST['dni'];
        $nombre   = $_POST['nombre_apellidos'];
        $telefono = $_POST['telefono'];
        $correo   = $_POST['correo'];
        $estado   = $_POST['estado'];

        if ($dni == "" || $nombre == "") {
            $arr_Respuestas = array('status' => false, 'mensaje' => 'Error, los campos DNI y Nombre son obligatorios');
        } else {
            $arrCliente = $objCliente->registrarCliente($dni, $nombre, $telefono, $correo, $estado);

            if ($arrCliente['id'] > 0) {
                $arr_Respuestas = array('status' => true, 'mensaje' => 'Cliente registrado con éxito');
            } else {
                $arr_Respuestas = array('status' => false, 'mensaje' => 'Error al registrar cliente');
            }
        }

        echo json_encode($arr_Respuestas);
    }
}

/* === EDITAR CLIENTE === */
if ($tipo == "editar") {
    if ($_POST) {
        $id       = $_POST['id'];
        $dni      = $_POST['dni'];
        $nombre   = $_POST['nombre_apellidos'];
        $telefono = $_POST['telefono'];
        $correo   = $_POST['correo'];
        $estado   = $_POST['estado'];

        if ($id == "" || $dni == "" || $nombre == "") {
            $arr_Respuestas = array('status' => false, 'mensaje' => 'Error, campos obligatorios vacíos');
        } else {
            $editado = $objCliente->editarCliente($id, $dni, $nombre, $telefono, $correo, $estado);

            if ($editado) {
                $arr_Respuestas = array('status' => true, 'mensaje' => 'Cliente actualizado con éxito');
            } else {
                $arr_Respuestas = array('status' => false, 'mensaje' => 'Error al actualizar cliente');
            }
        }
        echo json_encode($arr_Respuestas);
    }
}

/* === VER CLIENTE (precargar formulario) === */
if ($tipo == "ver") {
    if ($_POST) {
        $id = $_POST['id'];
        $cliente = $objCliente->obtenerCliente($id);

        if ($cliente) {
            $arr_Respuestas = array('status' => true, 'contenido' => $cliente);
        } else {
            $arr_Respuestas = array('status' => false, 'mensaje' => 'Cliente no encontrado');
        }
        echo json_encode($arr_Respuestas);
    }
}

/* === ELIMINAR CLIENTE === */
if ($tipo == "eliminar") {
    $id = $_POST['id'];
    
    try {
        $arr_Respuesta = $objCliente->eliminarCliente($id);
        
        if ($arr_Respuesta) {
            $response = array(
                'status' => true,
                'message' => 'Cliente eliminado correctamente.'
            );
        } else {
            $response = array(
                'status' => false,
                'message' => 'No se encontró el cliente o no pudo ser eliminado.'
            );
        }
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            $response = array(
                'status' => false,
                'message' => 'No se puede eliminar este cliente porque está asociado a otros registros.'
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
