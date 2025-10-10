<?php
require_once('../model/usuarioModel.php');

$tipo = $_REQUEST['tipo'];
$objUsuario = new UsuarioModel();

/* === LISTAR USUARIOS === */
if ($tipo == "listar") {
    $arr_Respuestas = array('status' => false, 'contenido' => '');
    $arr_usuarios = $objUsuario->obtener_usuarios();

    if (!empty($arr_usuarios)) {
        for ($i = 0; $i < count($arr_usuarios); $i++) {
            $id_usuario = $arr_usuarios[$i]->id;

            // Botones de acción
            $opciones = '
            <div class="d-flex justify-content-start gap-2">
                <a href="' . BASE_URL . 'editar-usuario/' . $id_usuario . '" class="btn btn-warning btn-sm d-inline-flex align-items-center">
                    <i class="fa fa-pencil"></i> Editar
                </a>
                
            </div>';

            $arr_usuarios[$i]->options = $opciones;
        }

        $arr_Respuestas['status'] = true;
        $arr_Respuestas['contenido'] = $arr_usuarios;
    }

    echo json_encode($arr_Respuestas);
}

/* === REGISTRAR USUARIO === */
if ($tipo == "registrar") {
    if ($_POST) {
        $nombre      = $_POST['nombre'];
        $contrasena  = $_POST['contrasena'];
        $rol         = $_POST['rol'];

        if ($nombre == "" || $contrasena == "" || $rol == "") {
            $arr_Respuestas = array('status' => false, 'mensaje' => 'Error, todos los campos son obligatorios');
        } else {
            // Registrar el usuario (la contraseña se puede encriptar)
            $arrUsuario = $objUsuario->registrarUsuario($nombre, $contrasena, $rol);

            if ($arrUsuario['id'] > 0) {
                $arr_Respuestas = array('status' => true, 'mensaje' => 'Usuario registrado con éxito');
            } else {
                $arr_Respuestas = array('status' => false, 'mensaje' => 'Error al registrar usuario');
            }
        }

        echo json_encode($arr_Respuestas);
    }
}

/* === EDITAR USUARIO === */
if ($tipo == "editar") {
    if ($_POST) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $rol  = $_POST['rol'];

        if ($id == "" || $nombre == "" || $rol == "") {
            $arr_Respuestas = array('status' => false, 'mensaje' => 'Error, campos obligatorios vacíos');
        } else {
            $editado = $objUsuario->editarUsuario($id, $nombre, $rol);

            if ($editado) {
                $arr_Respuestas = array('status' => true, 'mensaje' => 'Usuario actualizado con éxito');
            } else {
                $arr_Respuestas = array('status' => false, 'mensaje' => 'Error al actualizar usuario');
            }
        }

        echo json_encode($arr_Respuestas);
    }
}

/* === VER USUARIO (precargar formulario) === */
if ($tipo == "ver") {
    if ($_POST) {
        $id = $_POST['id'];
        $usuario = $objUsuario->obtenerUsuario($id);

        if ($usuario) {
            $arr_Respuestas = array('status' => true, 'contenido' => $usuario);
        } else {
            $arr_Respuestas = array('status' => false, 'mensaje' => 'Usuario no encontrado');
        }

        echo json_encode($arr_Respuestas);
    }
}


?>
