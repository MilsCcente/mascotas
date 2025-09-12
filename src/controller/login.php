<?php
require_once("../model/loginModel.php");

$objPersona = new loginModel();
$tipo = $_GET['tipo'];

if ($tipo == "iniciar_sesion") {
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $arrResponse = array('status' => false, 'msg' => '');

    // Buscar por usuario
    $arrPersona = $objPersona->buscarPersonaPorUsuario($usuario);

    if (empty($arrPersona)) {
        $arrResponse = array('status' => false, 'msg' => 'Error, usuario no está registrado');
    } else {
        // Comparación simple sin hash
        if ($password === $arrPersona->contraseña) {
            session_start();
            $_SESSION['sesion_ventas_id'] = $arrPersona->id;
            $_SESSION['sesion_usuario'] = $arrPersona->nombre;
            $arrResponse = array('status' => true, 'msg' => 'Ingresar al sistema');
        } else {
            $arrResponse = array('status' => false, 'msg' => 'Error, contraseña incorrecta');
        }
    }

    echo json_encode($arrResponse);
    exit;
}

if ($tipo == "cerrar_sesion") {
    session_start();
    session_unset();
    session_destroy();
    $arrResponse = array('status' => true);
    echo json_encode($arrResponse);
}

die;
