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
                <a href="' . BASE_URL . 'editar-perrito.php?id=' . $id_perrito . '" class="btn btn-warning btn-sm d-inline-flex align-items-center">
                    <i class="fa fa-pencil"></i> Editar
                </a>
                <button onclick="eliminarPerrito(' . $id_perrito . ');" class="btn btn-danger btn-sm d-inline-flex align-items-center">
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
