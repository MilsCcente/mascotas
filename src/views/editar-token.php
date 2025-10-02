<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Token</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card {
            width: 100%;
            max-width: 600px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            margin: 50px auto;
        }

        .card-header {
            background-color: rgb(176, 96, 241);
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 1.5rem;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .btn-primary {
            background-color: rgb(176, 96, 241);
            border-color: rgb(129, 92, 248);
        }

        .btn-primary:hover {
            background-color: rgb(134, 51, 243);
            border-color: rgb(138, 38, 246);
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header" id="titulo_form">Editar Token</div>
    <div class="card-body">
        <form id="frmToken">
            <input type="hidden" id="id" name="id">

            <div class="mb-3">
                <label for="id_cliente_api" class="form-label">Cliente API <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="id_cliente_api" name="id_cliente_api" required>
            </div>

            <div class="mb-3">
                <label for="token" class="form-label">Token <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="token" name="token" required>
            </div>

            <div class="mt-4">
                <button type="button" class="btn btn-primary w-100" onclick="actualizar_token();">Guardar Token</button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo BASE_URL ?>src/views/js/functions_token.js"></script>

<script>
    // Capturamos el ID desde la URL
    const id_t = <?php $pagina = explode("/", $_GET['views']); echo $pagina[1]; ?>;
    if (id_t) editar_token(id_t); // Si hay ID, cargamos los datos para editar
</script>

</body>
</html>
