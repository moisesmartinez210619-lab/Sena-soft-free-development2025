<?php
session_start();

// Verifica si el usuario está logueado
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login_admin.php");
    exit;
}

// Cerrar sesión
if (isset($_GET['cerrar']) && $_GET['cerrar'] === '1') {
    session_destroy();
    header("Location: login_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de administración</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

  <div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-blue-700">Panel de administración</h1>
    <a href="?cerrar=1" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Cerrar sesión</a>
  </div>

  <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
    <a href="crear_vuelo.php" class="bg-white shadow p-6 rounded-lg hover:bg-blue-50 text-center">
      <h2 class="text-xl font-semibold text-blue-700">✈️ Crear vuelo</h2>
    </a>
    <a href="editar_vuelo.php" class="bg-white shadow p-6 rounded-lg hover:bg-blue-50 text-center">
      <h2 class="text-xl font-semibold text-blue-700">🛫 Editar vuelos</h2>
    </a>
    <a href="consultar_reservas.php" class="bg-white shadow p-6 rounded-lg hover:bg-blue-50 text-center">
      <h2 class="text-xl font-semibold text-blue-700">📋 Consultar reservas</h2>
    </a>
  </div>

</body>
</html>


