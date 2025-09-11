<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Administrador - Mascotas</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    /* 🔹 Reset básico */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      height: 100vh;
      background: #f9f9f9;
    }

    /* ---------------- Sidebar (menú lateral) ---------------- */
    .sidebar {
      width: 230px;
      background: linear-gradient(135deg, #a78bfa, #7c3aed);
      color: white;
      display: flex;
      flex-direction: column;
      padding: 1rem;
      background-repeat: repeat;
      background-size: 80px; /* Tamaño de huellitas */
      transition: left 0.3s; /* Animación al abrir/cerrar en móvil */
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 2rem;
      font-size: 1.3rem;
      background: rgba(124, 58, 237, 0.9);
      padding: 0.5rem;
      border-radius: 8px;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      padding: 0.8rem 1rem;
      border-radius: 8px;
      display: block;
      margin-bottom: 0.5rem;
      transition: background 0.3s;
      font-weight: 500;
    }

    .sidebar a:hover {
      background: rgba(35, 13, 86, 0.2);
    }

    /* ---------------- Main (zona principal) ---------------- */
    .main {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    /* Barra superior */
    .header {
      background: #ede9fe;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solid #c4b5fd;
    }

    .header h1 {
      font-size: 1.2rem;
      color: #6d28d9;
    }

    .header .menu-toggle {
      display: none; /* Botón visible solo en móvil */
      background: #7c3aed;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      cursor: pointer;
    }

    .header .logout {
      background: #7c3aed;
      color: white;
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .header .logout:hover {
      background: #6d28d9;
    }

    /* Contenido principal */
    .content {
      padding: 2rem;
    }

    /* Tarjeta de bienvenida */
    .card {
      background: white;
      padding: 1.5rem;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      margin-bottom: 1.5rem;
    }

    .card h3 {
      margin-bottom: 0.5rem;
      color: #7c3aed;
    }

    /* Estadísticas */
    .stats {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .stat {
      flex: 1;
      background: #ede9fe;
      padding: 1rem;
      border-radius: 10px;
      text-align: center;
      min-width: 120px;
    }

    .stat h4 {
      font-size: 1rem;
      color: #6d28d9;
      margin-bottom: .3rem;
    }

    .stat p {
      font-size: 1.5rem;
      font-weight: bold;
      color: #4c1d95;
    }

    /* ---------------- Responsive (para celular) ---------------- */
    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        top: 0;
        left: -250px; /* Oculto por defecto */
        height: 100%;
        z-index: 1000;
      }

      .sidebar.show {
        left: 0; /* Cuando se abre */
      }

      .header .menu-toggle {
        display: block; /* Botón visible en móvil */
      }
    }
  </style>
  <script>const base_url = "<?php echo BASE_URL; ?>";</script>
</head>
<body>

  <!-- Sidebar con menú lateral -->
  <div class="sidebar" id="sidebar">
    <h2>🐾 Mascotas</h2>
    <a href="<?php echo BASE_URL;?>inicio">Inicio</a>
    <a href="<?php echo BASE_URL;?>mascotas">Perritos</a>
    <a href="<?php echo BASE_URL;?>usuarios">Usuarios</a>
    
  </div>

  <!-- Contenido principal -->
  <div class="main">
    <!-- Barra superior -->
    <div class="header">
      <h1>Panel de Administración</h1>
      <div>
        <!-- Botón que abre el menú en celular -->
        <button class="menu-toggle" onclick="toggleMenu()">☰</button>
        <!-- Botón de cerrar sesión -->
        <form action="logout.php" method="POST" style="display:inline;">
          <button class="logout">Cerrar Sesión</button>
        </form>
      </div>
    </div>

    <!-- Sección de contenido -->
    <div class="content">
      <!-- Tarjeta de bienvenida -->
      <div class="card">
        