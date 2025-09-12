<!-- Header -->
<div class="content-header">
    <div class="container-fluid">    
        <div class="row mb-3">
            <div class="col-sm-12 d-flex justify-content-between align-items-center">
                <h1 class="m-0 text-primary fw-bold">
                    <i class="fas fa-users"></i> Listado de Usuarios
                </h1>
                <a href="<?php echo BASE_URL;?>nuevo-usuario" class="btn btn-gradient">
                    <i class="fa fa-plus"></i> Agregar Usuario
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Card -->
<div class="card shadow-lg border-0 rounded-4 overflow-hidden">
    <div class="card-header bg-gradient d-flex justify-content-between align-items-center">
        <h3 class="card-title text-white m-0">
            <i class="fas fa-user-cog"></i> Usuarios
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-light btn-sm" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="tablaUsuarios" class="table table-hover align-middle mb-0">
                <thead class="table-gradient text-white">
                    <tr>
                        <th style="width: 70px;">Nro</th>
                        <th>Nombre</th>
                        <th>Rol</th>
                        <th style="width: 150px;">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbl_usuarios" style="font-family: 'Segoe UI', sans-serif; font-size: 15px;">
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
        padding: 8px 15px;
        border-radius: 8px;
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

    /* Animación hover en la tabla */
    #tablaUsuarios tbody tr:hover {
        background-color: #f3e8ff !important;
        transition: background 0.2s;
    }
</style>

<!-- Scripts -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo BASE_URL ?>src/views/js/functions_usuario.js"></script>
