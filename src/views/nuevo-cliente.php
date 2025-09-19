<?php include "include/header.php"; ?>
<div class="card">
  <h3>Registrar Cliente</h3>
  <form method="POST" action="<?php echo BASE_URL;?>src/controller/cliente.php?tipo=guardar">
    <div class="mb-3">
      <label>DNI</label>
      <input type="number" name="dni" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Nombre y Apellidos</label>
      <input type="text" name="nombre_apellidos" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Teléfono</label>
      <input type="text" name="telefono" class="form-control">
    </div>
    <div class="mb-3">
      <label>Correo</label>
      <input type="email" name="correo" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
  </form>
</div>
<?php include "include/footer.php"; ?>
