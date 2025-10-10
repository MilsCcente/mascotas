<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        .form-container {
            margin: 0px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 90vh;
            background-color: #f0f2f5;
        }
        .form {
            background-color: #ffffff;
            margin: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            font-family: Arial, sans-serif;
        }
        .form div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
            background-color: #f9f9f9;
        }
        input:focus, select:focus {
            border-color: #4CAF50;
            outline: none;
            background-color: #f1f9f1;
        }
        .button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #7c3aed, #c084fc);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .button.cancel {
            background-color: rgb(238, 29, 15);
        }
    </style>
</head>
<body>

<div class="form-container">
    <form class="form" id="frmRegistrarUsuario" autocomplete="off">
        <h3 class="text-center mb-4">Registrar Usuario</h3>

        <div>
            <label for="nombre">Usuario</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre de usuario" required>
        </div>

        <div>
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña segura" required>
        </div>

        <div>
            <label for="rol">Rol</label>
            <select id="rol" name="rol" required>
                <option value="">Seleccione un rol</option>
                <option value="admin">Administrador</option>
                <option value="usuario">Usuario</option>
            </select>
        </div>

        <div class="mt-4">
            <button type="button" class="button" onclick="registrar_usuario();">Guardar Usuario</button>
            <a href="<?php echo BASE_URL; ?>usuario" class="button cancel mt-2 d-block text-center">Cancelar</a>
        </div>
    </form>
</div>

<script src="<?php echo BASE_URL ?>src/views/js/functions_usuario.js"></script>

</body>
</html>
