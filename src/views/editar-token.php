<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Token</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #c3a5ff, #f4e1ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Poppins", sans-serif;
        }

        .card {
            width: 100%;
            max-width: 500px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            background: #fff;
        }

        .card-header {
            background: linear-gradient(90deg, #9b5efb, #8a42f6);
            color: #fff;
            text-align: center;
            font-size: 1.6rem;
            font-weight: bold;
            padding: 15px;
            letter-spacing: 0.5px;
        }

        .card-body {
            padding: 30px;
        }

        .form label {
            font-weight: 500;
            margin-bottom: 6px;
            display: block;
            color: #333;
        }

        .form input,
        .form select {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1rem;
            transition: all 0.3s ease;
            margin-bottom: 15px;
        }

        .form input:focus,
        .form select:focus {
            border-color: #9b5efb;
            box-shadow: 0 0 5px rgba(155, 94, 251, 0.3);
            outline: none;
        }

        .button {
            background-color: #9b5efb;
            border: none;
            color: #fff;
            padding: 12px 0;
            width: 100%;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .button:hover {
            background-color: #7f3cf0;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(155, 94, 251, 0.3);
        }

        h2 {
            text-align: center;
            color: #6a29e6;
            font-weight: 600;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header" id="titulo_form">Editar Token</div>
    <div class="card-body">
        <form class="form" id="frmEditarToken">
            <h2>Formulario de Edición</h2>

            <!-- ID oculto -->
            <input type="hidden" id="id_token" name="id_token">

            <div>
                <label for="id_cliente_api">Cliente</label>
                <select id="id_cliente_api" name="id_cliente_api" required>
                    <option value="">Seleccione cliente</option>
                    <!-- Se carga desde JS -->
                </select>
            </div>

            <div>
                <label for="token">Token</label>
                <input type="text" id="token" name="token" required readonly>
            </div>

            <div>
                <label for="estado">Estado</label>
                <select id="estado" name="estado" required>
                    <option value="">Seleccione estado</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>

            <button type="button" class="button" onclick="actualizar_token();">Actualizar Token</button>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo BASE_URL ?>src/views/js/functions_token.js"></script>

<script>
    // Capturar el ID desde la URL
    const id_t = <?php $pagina = explode("/", $_GET['views']); echo $pagina[1]; ?>;
    if (id_t) editar_token(id_t);
</script>

</body>
</html>
