<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Perrito</title>
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
    <div class="card-header" id="titulo_form">Editar Perrito</div>
    <div class="card-body">
        <form id="frmPerrito">
            <input type="hidden" id="id" name="id">

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="col-md-6">
                    <label for="raza" class="form-label">Raza</label>
                    <input type="text" class="form-control" id="raza" name="raza">
                </div>

                <div class="col-md-6">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="number" class="form-control" id="edad" name="edad" min="0">
                </div>

                <div class="col-md-6">
                    <label for="peso" class="form-label">Peso (kg)</label>
                    <input type="number" step="0.1" class="form-control" id="peso" name="peso" min="0">
                </div>

                <div class="col-md-6">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" class="form-control" id="color" name="color">
                </div>

               <div class="col-md-6">
    <label for="genero" class="form-label">Género</label>
    <select class="form-select" id="genero" name="genero" required>
        <option value="">Seleccione</option>
        <option value="macho">macho</option>
        <option value="hembra">hembra</option>
    </select>
</div>


                <div class="col-md-6">
                    <label for="vacunado" class="form-label">Vacunado</label>
                    <select class="form-select" id="vacunado" name="vacunado">
                        <option value="">Seleccione</option>
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <button type="button" class="btn btn-primary w-100" onclick="actualizar_perrito();">Guardar Perrito</button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo BASE_URL ?>src/views/js/functions_perrito.js"></script>

<script>
    // Capturamos el ID desde la URL
    const id_p = <?php $pagina = explode("/", $_GET['views']); echo $pagina[1]; ?>;
    if(id_p) editar_perrito(id_p); // Si hay ID, cargamos los datos para editar
</script>