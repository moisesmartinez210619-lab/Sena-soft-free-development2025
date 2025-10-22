<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vuelos disponibles</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 p-6 relative">

  <!-- 🔧 Ícono de configuración arriba a la derecha -->
  <button id="btnConfig" class="absolute top-4 right-6 text-gray-600 hover:text-blue-600">
    <i data-lucide="settings" class="w-8 h-8"></i>
  </button>

  <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">Vuelos disponibles</h2>
  <h2 class="text-3xl font-bold text-center text-green-700 mb-6">Volando con Aerosoft</h2>
  <div id="listaVuelos" class="grid gap-4"></div>

  <script>
  // Activar iconos Lucide
  lucide.createIcons();

  // 🔹 Al hacer clic en el engranaje → redirige a login_admin.html
  document.getElementById("btnConfig").addEventListener("click", () => {
    window.location.href = "login_admin.html";
  });

  // Tu código original
  document.addEventListener("DOMContentLoaded", () => {
    fetch("../backend/controllers/vuelosController.php?accion=listar")
      .then(res => res.json())
      .then(vuelos => {
        const contenedor = document.getElementById("listaVuelos");
        contenedor.innerHTML = vuelos.map(v => `
          <div class="bg-white shadow-lg p-4 rounded-lg">
            <h3 class="text-xl font-semibold text-blue-700">${v.origen} → ${v.destino}</h3>
            <p><strong>Fecha salida:</strong> ${v.fecha_salida}</p>
            <p><strong>Fecha llegada:</strong> ${v.fecha_llegada}</p>
            <p><strong>Avión:</strong> ${v.modelo}</p>
            <p><strong>Precio base:</strong> $${v.precio_base}</p>
            <a href="reservas.php?id_vuelo=${v.id_vuelo}" class="mt-3 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Reservar</a>
          </div>
        `).join("");
      });
  });
  </script>
  
</body>
</html>
