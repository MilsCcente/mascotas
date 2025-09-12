<!-- Header -->
<div class="content-header py-3 shadow-sm" style="background: linear-gradient(135deg, #7c3aed, #6d28d9);">
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
            <div class="col-sm-6">
                <h1 class="m-0 fw-bold text-white">
                    <i class="fas fa-dog"></i> Listado de Perritos
                </h1>
            </div>
            <div class="col-sm-6 text-end">
                <a href="<?php echo BASE_URL;?>nueva-mascota" class="text-decoration-none">
                    <button type="button" class="btn btn-gradient shadow-sm">
                        <i class="fa fa-plus me-2"></i> Agregar Nuevo Perrito
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Card -->
<div class="card m-3 shadow-lg border-0 rounded-4 overflow-hidden">
    <div class="card-header bg-gradient text-white d-flex justify-content-between align-items-center">
        <h3 class="card-title fw-bold mb-0">
            <i class="fas fa-paw"></i> Perritos Registrados
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-light btn-sm" data-bs-toggle="collapse" data-bs-target="#tablaPerritosBody" aria-expanded="true" aria-controls="tablaPerritosBody">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="card-body p-0 collapse show" id="tablaPerritosBody">
        <div class="table-responsive">
            <table id="tablaPerritos" class="table table-hover align-middle mb-0">
                <thead class="table-gradient text-white text-center">
                    <tr>
                        <th>Nro</th>
                        <th>Nombre</th>
                        <th>Raza</th>
                        <th>Edad (meses)</th>
                        <th>Peso (kg)</th>
                        <th>Color</th>
                        <th>Género</th>
                        <th>Vacunado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbl_perritos" class="text-center" style="font-family: 'Segoe UI', sans-serif;">
                    <!-- Datos dinámicos -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Estilos extras -->
<style>
    /* Botón degradado */
    .btn-gradient {
        background: linear-gradient(135deg, #7c3aed, #a78bfa);
        color: #fff !important;
        font-weight: 600;
        padding: 10px 18px;
        border-radius: 10px;
        transition: all 0.3s ease;
        border: none;
    }
    .btn-gradient:hover {
        background: linear-gradient(135deg, #6d28d9, #9333ea);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(124, 58, 237, 0.4);
    }

    /* Card header con degradado */
    .bg-gradient {
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
    }

    /* Encabezado tabla degradado */
    .table-gradient {
        background: linear-gradient(135deg, #6d28d9, #9333ea);
    }

    /* Hover en tabla */
    #tablaPerritos tbody tr:hover {
        background-color: #f3e8ff !important;
        transition: background 0.2s;
    }
</style>

<!-- Scripts -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo BASE_URL ?>src/views/js/functions_perrito.js"></script>
