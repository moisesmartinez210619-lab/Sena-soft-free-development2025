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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel de administración</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

  <!-- Barra superior -->
  <header class="bg-blue-700 text-white py-4 px-6 flex justify-between items-center shadow-md">
    <h1 class="text-2xl font-semibold">Panel de Administración ✈️</h1>
    <div class="space-x-3">
      <a href="vuelos.html" class="bg-white text-blue-700 px-4 py-2 rounded hover:bg-gray-200 font-medium">🏠 Volver al Home</a>
      <a href="?cerrar=1" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 font-medium">Cerrar sesión</a>
    </div>
  </header>

  <!-- Contenido principal -->
  <main class="flex-grow container mx-auto px-6 py-8">
    <h2 class="text-xl font-semibold text-blue-700 mb-4">Crear nuevo vuelo</h2>

    <!-- Formulario de creación -->
    <form id="formCrearVuelo" method="POST" action="crear_vuelo.php" class="bg-white shadow-md rounded-lg p-6 space-y-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block font-medium text-gray-700">Número de vuelo</label>
          <input type="text" name="numero" required class="w-full p-2 border rounded">
        </div>
        <div>
          <label class="block font-medium text-gray-700">Aerolínea</label>
          <input type="text" name="aerolinea" required class="w-full p-2 border rounded">
        </div>
        <div>
          <label class="block font-medium text-gray-700">Origen</label>
          <input type="text" name="origen" required class="w-full p-2 border rounded">
        </div>
        <div>
          <label class="block font-medium text-gray-700">Destino</label>
          <input type="text" name="destino" required class="w-full p-2 border rounded">
        </div>
        <div>
          <label class="block font-medium text-gray-700">Fecha de salida</label>
          <input type="date" name="fecha" required class="w-full p-2 border rounded">
        </div>
        <div>
          <label class="block font-medium text-gray-700">Hora de salida</label>
          <input type="time" name="hora" required class="w-full p-2 border rounded">
        </div>
        <div>
          <label class="block font-medium text-gray-700">Precio</label>
          <input type="number" name="precio" step="0.01" required class="w-full p-2 border rounded">
        </div>
        <div>
          <label class="block font-medium text-gray-700">Capacidad</label>
          <input type="number" name="capacidad" required class="w-full p-2 border rounded">
        </div>
      </div>
      <button type="submit" class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-800">Crear vuelo</button>
    </form>

    <!-- Tabla de vuelos -->
    <h2 class="text-xl font-semibold text-blue-700 mt-10 mb-4">Lista de vuelos</h2>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
      <table class="min-w-full text-sm text-gray-700">
        <thead class="bg-blue-100 text-blue-800">
          <tr>
            <th class="py-2 px-3 text-left"># Vuelo</th>
            <th class="py-2 px-3 text-left">Aerolínea</th>
            <th class="py-2 px-3 text-left">Origen</th>
            <th class="py-2 px-3 text-left">Destino</th>
            <th class="py-2 px-3 text-left">Fecha</th>
            <th class="py-2 px-3 text-left">Hora</th>
            <th class="py-2 px-3 text-left">Precio</th>
            <th class="py-2 px-3 text-left">Capacidad</th>
            <th class="py-2 px-3 text-center">Acciones</th>
          </tr>
        </thead>
        <tbody id="tablaVuelos">
          <!-- Aquí se mostrarán los vuelos desde PHP en el futuro -->
          <tr class="border-t">
            <td class="py-2 px-3">A001</td>
            <td class="py-2 px-3">AeroSoft</td>
            <td class="py-2 px-3">Bogotá</td>
            <td class="py-2 px-3">San Andrés</td>
            <td class="py-2 px-3">2025-10-30</td>
            <td class="py-2 px-3">08:30</td>
            <td class="py-2 px-3">$250000</td>
            <td class="py-2 px-3">180</td>
            <td class="py-2 px-3 text-center">
              <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" onclick="eliminarVuelo(this)">Eliminar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>

  <footer class="bg-blue-700 text-white text-center py-3 mt-8">
    © 2025 AeroSoft | Panel Administrador
  </footer>

  <script>
    // Función simulada de eliminar vuelo
    function eliminarVuelo(boton) {
      if (confirm("¿Deseas eliminar este vuelo?")) {
        boton.closest("tr").remove();
        alert("Vuelo eliminado correctamente (simulado).");
      }
    }

    // Aquí más adelante se podrá usar fetch o AJAX para conectar con PHP/MySQL
  </script>
</body>
</html>
