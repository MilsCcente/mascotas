<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Cliente</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card {
            width: 100%;
            max-width: 700px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            background-color:rgb(176, 96, 241);
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 1.5rem;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .btn-primary {
            background-color:rgb(176, 96, 241);
            border-color:rgb(129, 92, 248);
        }

        .btn-primary:hover {
            background-color:rgb(134, 51, 243);
            border-color:rgb(138, 38, 246);
        }
    </style>
</head>
<body>

<div class="card">
    <!-- Cambié el título -->
    <div class="card-header" id="titulo_form">Editar Cliente</div>
    <div class="card-body">
        <!-- Formulario clientes -->
        <form id="frmCliente">
            <!-- Campo oculto para el ID -->
            <input type="hidden" id="id" name="id">

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="dni" class="form-label">DNI <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="dni" name="dni" required>
                </div>

                <div class="col-md-6">
                    <label for="nombre_apellidos" class="form-label">Nombre y Apellidos <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nombre_apellidos" name="nombre_apellidos" required>
                </div>

                <div class="col-md-6">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono">
                </div>

                <div class="col-md-6">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo">
                </div>

                <div class="col-md-6">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" id="estado" name="estado">
                        <option value="">Seleccione</option>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <!-- Botón para guardar -->
                <button type="button" class="btn btn-primary w-100" onclick="actualizar_cliente();">Guardar Cliente</button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo BASE_URL ?>src/views/js/functions_cliente.js"></script>

<script>
    // Capturamos el ID desde la URL
    const id_c = <?php $pagina = explode("/", $_GET['views']); echo $pagina[1]; ?>;
    if(id_c) editar_cliente(id_c); // Si hay ID, cargamos los datos para editar
</script>
</body>
</html>
