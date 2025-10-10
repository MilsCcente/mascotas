<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            width: 100%;
            max-width: 600px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            margin: 60px auto;
        }

        .card-header {
            background-color: #a66cff;
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 1.6rem;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .btn-primary {
            background-color: #a66cff;
            border-color: #8e5efc;
        }

        .btn-primary:hover {
            background-color: #8a46ff;
            border-color: #752efb;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">Registrar Usuario</div>
    <div class="card-body">
        <form id="frmUsuario">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre completo <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej. Juan Pérez" required>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="correo" name="correo" placeholder="Ej. correo@gmail.com" required>
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ej. jperez" required>
            </div>

            <div class="mb-3">
                <label for="clave" class="form-label">Contraseña <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="clave" name="clave" placeholder="********" required>
            </div>

            <div class="mt-4">
                <button type="button" class="btn btn-primary w-100" onclick="registrar_usuario();">Registrar</button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
// Función para registrar usuario
function registrar_usuario() {
    const datos = new FormData(document.getElementById("frmUsuario"));

    fetch("<?php echo BASE_URL ?>src/controllers/usuario_controller.php?op=registrar", {
        method: "POST",
        body: datos
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            swal("✅ Registro exitoso", data.message, "success");
            document.getElementById("frmUsuario").reset();
        } else {
            swal("❌ Error", data.message, "error");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        swal("Error", "Ocurrió un problema con el servidor", "error");
    });
}
</script>

</body>
</html>
