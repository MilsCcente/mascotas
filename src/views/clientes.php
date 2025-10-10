<!-- Header -->
<div class="content-header py-3 shadow-sm" style="background: linear-gradient(135deg, #2563eb, #1d4ed8);">
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
            <div class="col-sm-6">
                <h1 class="m-0 fw-bold text-white">
                    <i class="fas fa-users"></i> Listado de Clientes
                </h1>
            </div>
            <div class="col-sm-6 text-end">
                <a href="<?php echo BASE_URL;?>nuevo-cliente" class="text-decoration-none">
                    <button type="button" class="btn btn-gradient shadow-sm">
                        <i class="fa fa-plus me-2"></i> Agregar Nuevo Cliente
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
            <i class="fas fa-address-card"></i> Clientes Registrados
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-light btn-sm" data-bs-toggle="collapse" data-bs-target="#tablaClientesBody" aria-expanded="true" aria-controls="tablaClientesBody">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="card-body p-0 collapse show" id="tablaClientesBody">
        <div class="table-responsive">
            <table id="tablaClientes" class="table table-hover align-middle mb-0">
                <thead class="table-gradient text-white text-center">
                    <tr>
                        <th>Nro</th>
                        <th>DNI</th>
                        <th>Nombre y Apellidos</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbl_clientes" class="text-center" style="font-family: 'Segoe UI', sans-serif;">
                    <!-- Datos dinámicos de clientes -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Estilos extras -->
<style>
    /* Botón degradado */
    .btn-gradient {
        background: linear-gradient(135deg, #2563eb, #60a5fa);
        color: #fff !important;
        font-weight: 600;
        padding: 10px 18px;
        border-radius: 10px;
        transition: all 0.3s ease;
        border: none;
    }
    .btn-gradient:hover {
        background: linear-gradient(135deg, #1d4ed8, #3b82f6);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.4);
    }

    /* Card header con degradado */
    .bg-gradient {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
    }

    /* Encabezado tabla degradado */
    .table-gradient {
        background: linear-gradient(135deg, #1d4ed8, #3b82f6);
    }

    /* Hover en tabla */
    #tablaClientes tbody tr:hover {
        background-color: #dbeafe !important;
        transition: background 0.2s;
    }
</style>

<!-- Scripts -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo BASE_URL ?>src/views/js/functions_cliente.js"></script>

