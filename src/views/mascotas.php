<!-- Header -->
<div class="content-header py-3 bg-light shadow-sm">
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
            <div class="col-sm-6">
                <h1 class="m-0 fw-bold text-primary">Listado de Perritos</h1>
            </div>
            <div class="col-sm-6 text-end">
                <a href="<?php echo BASE_URL;?>nueva-mascota" class="text-decoration-none">
                    <button type="button" class="btn btn-success btn-lg shadow-sm">
                        <i class="fa fa-plus me-2"></i> Agregar Nuevo Perrito
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Card -->
<div class="card m-3 shadow border-0 rounded-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
        <h3 class="card-title fw-bold mb-0">Perritos Registrados</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-light btn-sm" data-bs-toggle="collapse" data-bs-target="#tablaPerritosBody" aria-expanded="true" aria-controls="tablaPerritosBody">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="card-body p-0 collapse show" id="tablaPerritosBody">
        <div class="table-responsive">
            <table id="tablaPerritos" class="table table-striped table-hover table-bordered align-middle mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Nro</th>
                        <th>Nombre</th>
                        <th>Raza</th>
                        <th>Edad (años)</th>
                        <th>Peso (kg)</th>
                        <th>Color</th>
                        <th>Género</th>
                        <th>Vacunado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbl_perritos" class="text-center" style="font-family: 'Times New Roman', Times, serif;">
                    <!-- Datos dinámicos -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script -->
<script src="<?php echo BASE_URL ?>src/views/js/functions_perrito.js"></script>
