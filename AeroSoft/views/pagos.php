<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar pago</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

  <div class="max-w-lg mx-auto bg-white shadow-lg rounded-xl p-6">
    <h2 class="text-2xl font-bold text-center text-yellow-600 mb-4">Registrar pago</h2>

    <form id="formPago">
      <!-- Campo actualizado -->
      <label class="block mb-2 font-medium">Código de reserva</label>
      <input name="codigo_reserva" required class="border p-2 w-full rounded mb-3" placeholder="Ej: RSV-1A2B3C">

      <label class="block mb-2 font-medium">Método de pago</label>
      <select name="metodo" class="border p-2 w-full rounded mb-3" required>
        <option value="">Seleccione un método</option>
        <option value="tarjeta">Tarjeta</option>
        <option value="pse">PSE</option>
        <option value="efectivo">Efectivo</option>
      </select>

      <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600 w-full font-semibold">
        Confirmar pago
      </button>
    </form>

    <div id="mensaje" class="mt-4 text-center"></div>

    <!-- 🔙 Botón para volver al Home -->
    <div class="text-center mt-6">
      <a href="../index.html" 
         class="inline-block bg-gray-200 text-gray-800 px-5 py-2 rounded-lg font-semibold hover:bg-gray-300 transition">
        ⬅️ Volver al inicio
      </a>
    </div>
  </div>

  <script>
  const form = document.getElementById("formPago");

  form.addEventListener("submit", async e => {
    e.preventDefault();
    const datos = new FormData(form);

    try {
      const res = await fetch("../backend/controllers/PagosController.php", {
        method: "POST",
        body: datos
      });

      const data = await res.json();
      const msg = document.getElementById("mensaje");

      if (data.success) {
        msg.innerHTML = `
          <p class="text-green-600 font-semibold">
             ${data.mensaje}<br>
            Código de tiquete: <strong>${data.codigo_tiquete}</strong>
          </p>
          <a href="../${data.archivo_pdf}" target="_blank" 
             class="underline text-blue-600 hover:text-blue-800 mt-2 inline-block">
             Ver PDF del tiquete
          </a>`;
        form.reset();
      } else {
        msg.innerHTML = `<p class="text-red-600 font-semibold">⚠️ ${data.mensaje}</p>`;
      }
    } catch (error) {
      document.getElementById("mensaje").innerHTML = 
        `<p class="text-red-600 font-semibold">Error al conectar con el servidor.</p>`;
    }
  });
  </script>

</body>
</html>

  
  </script>

</body>
</html>

