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

  <script>
    const base_url = "<?php echo BASE_URL; ?>";

    document.addEventListener('DOMContentLoaded', function() {
      const toggleBtn = document.querySelector('.menu-toggle');
      const sidebar = document.querySelector('.sidebar');

      if(toggleBtn) {
        toggleBtn.addEventListener('click', function() {
          sidebar.classList.toggle('show');
        });
      }
    });

    async function cerrar_sesion() {
      try {
        let respuesta = await fetch(base_url+'src/controller/login.php?tipo=cerrar_sesion',{
          method: 'POST', 
          mode: 'cors',
          cache:'no-cache',
        });
        let json = await respuesta.json();
        if (json.status) {
          location.replace(base_url+'login');
        }
      } catch(e) {
        console.error(e);
      }
    }
  </script>

  <style>
    /* Reset básico */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f9f9f9; }

    /* ---------------- Header fijo ---------------- */
    .header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 70px;
      background: #ede9fe;
      border-bottom: 2px solid #c4b5fd;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 2rem;
      z-index: 1000;
    }

    .header h1 { font-size: 1.2rem; color: #6d28d9; }
    .header .menu-toggle { display: none; background: #7c3aed; color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; }
    .header .logout { background: #7c3aed; color: white; padding: 0.5rem 1rem; border: none; border-radius: 8px; cursor: pointer; transition: background 0.3s; }
    .header .logout:hover { background: #6d28d9; }

    /* ---------------- Sidebar fijo ---------------- */
    .sidebar {
      position: fixed;
      top: 70px; /* Debajo del header */
      left: 0;
      width: 230px;
      height: calc(100% - 70px);
      background: linear-gradient(135deg, #a78bfa, #7c3aed);
      color: white;
      display: flex;
      flex-direction: column;
      padding: 1rem;
      overflow-y: auto;
      transition: left 0.3s;
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
    .sidebar a:hover { background: rgba(35, 13, 86, 0.2); }

    /* ---------------- Contenido principal ---------------- */
    .main {
      margin-left: 230px; /* ancho del sidebar */
      margin-top: 70px;   /* altura del header */
      padding: 2rem;
      background: #f9f9f9;
      min-height: calc(100vh - 70px);
    }

    .content {
      max-width: 1200px;
      margin: auto;
    }

    .card {
      background: white;
      padding: 1.5rem;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      margin-bottom: 1.5rem;
    }
    .card h3 { margin-bottom: 0.5rem; color: #7c3aed; }

    /* ---------------- Footer fijo (opcional) ---------------- */
    .footer {
      position: fixed;
      bottom: 0;
      left: 230px;
      width: calc(100% - 230px);
      background: #ede9fe;
      padding: 1rem;
      text-align: center;
      border-top: 2px solid #c4b5fd;
    }

    /* ---------------- Responsive (móvil) ---------------- */
    @media (max-width: 768px) {
      .sidebar { left: -250px; top: 70px; height: calc(100% - 70px); }
      .sidebar.show { left: 0; }
      .header .menu-toggle { display: block; }
      .main { margin-left: 0; }
      .footer { left: 0; width: 100%; }
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h2>🐾 Mascotas</h2>
    <a href="<?php echo BASE_URL;?>inicio">Inicio</a>
    <a href="<?php echo BASE_URL;?>mascotas">Perritos</a>
    <a href="<?php echo BASE_URL;?>usuario">Usuarios</a>
  </div>

  <!-- Header -->
  <div class="header">
    <h1>Panel de Administración</h1>
    <div>
      <button class="menu-toggle">☰</button>
      <button type="button" onclick="cerrar_sesion();" class="logout">
        <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
      </button>
    </div>
  </div>

  <!-- Contenido principal -->
  <div class="main">
    <div class="content">
      <div class="card">


      <!-- Sidebar -->
<div class="sidebar">
  <h2>🐾 Mascotas</h2>
  <a href="<?php echo BASE_URL;?>inicio">Inicio</a>
  <a href="<?php echo BASE_URL;?>mascotas">Perritos</a>
  <a href="<?php echo BASE_URL;?>usuario">Usuarios</a>
  <a href="<?php echo BASE_URL;?>clientes">Clientes</a> <!-- 🔹 Nuevo -->
  <a href="<?php echo BASE_URL;?>token">Token</a>
</div>
