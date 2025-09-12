<?php
require_once('../model/mascotaModel.php');


$tipo = $_REQUEST['tipo'];

$objPerrito = new MascotaModel();


if ($tipo == "listar") {
    $arr_Respuestas = array('status' => false, 'contenido' => '');
    $arr_perritos = $objPerrito->obtener_perritos(); // Método que obtiene todos los perritos

    if (!empty($arr_perritos)) {
        for ($i = 0; $i < count($arr_perritos); $i++) {
            $id_perrito = $arr_perritos[$i]->id;

            // Botones de acción
            $opciones = '
            <div class="d-flex justify-content-start gap-2">
                <a href="' . BASE_URL . 'editar-mascota/'. $id_perrito . '" class="btn btn-warning btn-sm d-inline-flex align-items-center">
                    <i class="fa fa-pencil"></i> Editar
                </a>
                <button onclick="eliminar_perrito(' . $id_perrito . ');" class="btn btn-danger btn-sm d-inline-flex align-items-center">
                    <i class="fa fa-trash"></i> Eliminar
                </button>
            </div>';

            $arr_perritos[$i]->options = $opciones;
        }

        $arr_Respuestas['status'] = true;
        $arr_Respuestas['contenido'] = $arr_perritos;
    }

    echo json_encode($arr_Respuestas);
}

if ($tipo == "registrar") {
    if ($_POST) {
        $nombre   = $_POST['nombre'];
        $raza     = $_POST['raza'];
        $edad     = $_POST['edad'];
        $peso     = $_POST['peso'];
        $color    = $_POST['color'];
        $genero   = $_POST['genero'];
        $vacunado = isset($_POST['vacunado']) ? 1 : 0; // Checkbox o valor booleano

        if ($nombre == "" || $genero == "") {
            $arr_Respuestas = array('status' => false, 'mensaje' => 'Error, los campos Nombre y Género son obligatorios');
        } else {
            // Llamada al modelo para registrar el perrito
            $arrPerrito = $objPerrito->registrarPerrito($nombre, $raza, $edad, $peso, $color, $genero, $vacunado);

            if ($arrPerrito['id'] > 0) {
                $arr_Respuestas = array('status' => true, 'mensaje' => 'Perrito registrado con éxito');
            } else {
                $arr_Respuestas = array('status' => false, 'mensaje' => 'Error al registrar perrito');
            }
        }

        echo json_encode($arr_Respuestas);
    }
}
/* === EDITAR PERRITO === */
if ($tipo == "editar") {
    if ($_POST) {
        $id      = $_POST['id'];
        $nombre  = $_POST['nombre'];
        $raza    = $_POST['raza'];
        $edad    = $_POST['edad'];
        $peso    = $_POST['peso'];
        $color   = $_POST['color'];
        $genero  = $_POST['genero'];
        $vacunado = $_POST['vacunado'];

        if ($id == "" || $nombre == "" || $genero == "" || $vacunado === "") {
            $arr_Respuestas = array('status' => false, 'mensaje' => 'Error, campos vacíos');
        } else {
            $editado = $objPerrito->editarPerrito(
                $id, $nombre, $raza, $edad, $peso, $color, $genero, $vacunado
            );

            if ($editado) {
                $arr_Respuestas = array('status' => true, 'mensaje' => 'Perrito actualizado con éxito');
            } else {
                $arr_Respuestas = array('status' => false, 'mensaje' => 'Error al actualizar perrito');
            }
        }
        echo json_encode($arr_Respuestas);
    }
}

/* === VER PERRITO (para precargar el form) === */
if ($tipo == "ver") {
    if ($_POST) {
        $id = $_POST['id'];
        $perrito = $objPerrito->obtenerPerrito($id);

        if ($perrito) {
            $arr_Respuestas = array('status' => true, 'contenido' => $perrito);
        } else {
            $arr_Respuestas = array('status' => false, 'mensaje' => 'Perrito no encontrado');
        }
        echo json_encode($arr_Respuestas);
    }
}

/* === ELIMINAR PERRITO === */
if ($tipo == "eliminar") {
    $id = $_POST['id'];
    
    try {
        $arr_Respuesta = $objPerrito->eliminarPerrito($id);
        
        if ($arr_Respuesta) {
            $response = array(
                'status' => true,
                'message' => 'Perrito eliminado correctamente.'
            );
        } else {
            $response = array(
                'status' => false,
                'message' => 'No se encontró el perrito o no pudo ser eliminado.'
            );
        }
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            $response = array(
                'status' => false,
                'message' => 'No se puede eliminar este perrito porque está asociado a otros registros.'
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
