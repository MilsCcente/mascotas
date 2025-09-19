<?php include "include/header.php"; ?>
<div class="card">
  <h3>Listado de Clientes</h3>
  <a href="<?php echo BASE_URL;?>nuevo-cliente" class="btn btn-primary mb-2">Nuevo Cliente</a>
  <table class="table table-bordered" id="tablaClientes">
    <thead>
      <tr>
        <th>ID</th>
        <th>DNI</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>
<script src="<?php echo BASE_URL;?>views/js/functions_cliente.js"></script>
<script>listarClientes();</script>
<?php include "include/footer.php"; ?>
