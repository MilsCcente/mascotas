<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Panel Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #c084fc, #a78bfa, #7c3aed);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background: #fff;
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      width: 350px;
      text-align: center;
      animation: fadeIn 1s ease-in-out;
    }

    .login-container img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 1rem;
      border: 3px solid #c4b5fd;
      box-shadow: 0 0 8px rgba(124, 58, 237, 0.5);
    }

    .login-container h2 {
      color: #6d28d9;
      margin-bottom: 1.5rem;
    }

    .form-group {
      margin-bottom: 1.2rem;
      text-align: left;
    }

    .form-group label {
      display: block;
      color: #6d28d9;
      font-weight: bold;
      margin-bottom: 0.3rem;
    }

    .form-group input {
      width: 100%;
      padding: 0.8rem;
      border: 1px solid #c4b5fd;
      border-radius: 8px;
      outline: none;
      transition: border 0.3s;
    }

    .form-group input:focus {
      border: 1px solid #7c3aed;
      box-shadow: 0 0 5px rgba(124, 58, 237, 0.5);
    }

    .btn-login {
      width: 100%;
      background: #7c3aed;
      color: white;
      padding: 0.8rem;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn-login:hover {
      background: #6d28d9;
    }

    .extra {
      margin-top: 1rem;
      font-size: 0.9rem;
    }

    .extra a {
      color: #7c3aed;
      text-decoration: none;
      font-weight: bold;
    }

    .extra a:hover {
      text-decoration: underline;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>

  <!-- Sweet Alerts css -->
  <link href="<?php echo BASE_URL ?>src/views/pp/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
  <script>
    const base_url = '<?php echo BASE_URL; ?>';
    const base_url_server = '<?php echo BASE_URL_SERVER; ?>';
  </script>
</head>
<body>

  <div class="login-container">
    


    <h2>Panel de Administración</h2>
    <form action="" id="frmIniciar" method="POST">
      <div class="form-group">

      <img src="src/img/logo.png" alt="Logo" >

        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required>
      </div>

      <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
      </div>

      <button type="submit" class="btn-login">Iniciar Sesión</button>

      <div class="extra">
        <p><a href="#">¿Olvidaste tu contraseña?</a></p>
      </div>
    </form>
    <p class="text-center mt-3 text-muted">&copy; 2025 Panel Admin</p>
  </div>
  
  <script src="<?php echo BASE_URL; ?>src/views/js/funtions_login.js"></script>
  <!-- Sweet Alerts Js-->
  <script src="<?php echo BASE_URL ?>src/views/pp/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
