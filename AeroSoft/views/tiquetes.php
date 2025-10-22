<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consultar tiquete</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

  <div class="max-w-lg mx-auto bg-white shadow-lg rounded-xl p-6">
    <h2 class="text-2xl font-bold text-center text-purple-700 mb-4">Consultar tiquete</h2>

    <form id="formTiquete">
      <label class="block mb-2 font-medium">ID de reserva</label>
      <input name="id_reserva" required class="border p-2 w-full rounded mb-3">

      <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 w-full font-semibold">Consultar</button>
    </form>

    <div id="resultado" class="mt-4 text-center"></div>
  </div>

  <script>
  const form = document.getElementById("formTiquete");
  form.addEventListener("submit", async e => {
    e.preventDefault();
    const id_reserva = form.id_reserva.value;
    const res = await fetch(`../backend/controllers/TiquetesController.php?id_reserva=${id_reserva}`);
    const data = await res.json();

    const div = document.getElementById("resultado");
    if (data && data.codigo_tiquete) {
      div.innerHTML = `
        <p class="text-green-600 font-semibold">Tiquete encontrado </p>
        <p><strong>Código:</strong> ${data.codigo_tiquete}</p>
        <a href="../${data.archivo_pdf}" target="_blank" class="underline text-blue-600">Ver PDF</a>
      `;
    } else {
      div.innerHTML = `<p class="text-red-600 font-semibold">No se encontró un tiquete para esa reserva.</p>`;
    }
  });
  </script>

</body>
</html>
