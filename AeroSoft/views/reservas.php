<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservar vuelo</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

  <div class="max-w-lg mx-auto bg-white shadow-lg rounded-xl p-6">
    <h2 class="text-2xl font-bold text-center text-blue-700 mb-4">Crear reserva</h2>

    <form id="formReserva">
      <input type="hidden" name="id_vuelo" value="<?php echo $_GET['id_vuelo'] ?? ''; ?>">

      <label class="block mb-2 font-medium">Nombre completo</label>
      <input name="nombres" required class="border p-2 w-full rounded mb-3">

      <label class="block mb-2 font-medium">Tipo de documento</label>
      <select name="tipo_documento" class="border p-2 w-full rounded mb-3">
        <option>CC</option><option>TI</option><option>CE</option>
      </select>

      <label class="block mb-2 font-medium">Número de documento</label>
      <input name="numero_documento" required class="border p-2 w-full rounded mb-3">

      <label class="block mb-2 font-medium">Correo</label>
      <input name="correo" type="email" required class="border p-2 w-full rounded mb-3">

      <label class="block mb-2 font-medium">Teléfono</label>
      <input name="telefono" class="border p-2 w-full rounded mb-3">

      <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 w-full font-semibold">Guardar reserva</button>
    </form>

    <div id="mensaje" class="mt-4 text-center"></div>

    <!-- Enlaces de navegación -->
    <div class="flex flex-col items-center gap-3 mt-6">
      <a href="../views/pagos.php" class="text-blue-600 hover:underline font-medium">Ir a pagos</a>
      <!-- 🔹 Nuevo botón para volver al home -->
      <a href="home.php" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-semibold">
        Volver al inicio
      </a>
    </div>
  </div>

  <script>
  const form = document.getElementById("formReserva");
  form.addEventListener("submit", async e => {
    e.preventDefault();
    const datos = new FormData(form);
    const msg = document.getElementById("mensaje");

    msg.innerHTML = '<p class="text-blue-600 font-semibold">Procesando reserva...</p>';

    try {
      const res = await fetch("../backend/controllers/ReservasController.php", {
        method: "POST",
        body: datos
      });
      const data = await res.json();

      if (data.success) {
        msg.innerHTML = `<p class="text-green-600 font-semibold">Reserva creada con éxito 🎉<br>Código: ${data.codigo}</p>`;
      } else {
        msg.innerHTML = `<p class="text-red-600 font-semibold">${data.mensaje}</p>`;
      }
    } catch (error) {
      msg.innerHTML = `<p class="text-red-600 font-semibold">Error al conectar con el servidor.</p>`;
    }
  });
  </script>

</body>
</html>
