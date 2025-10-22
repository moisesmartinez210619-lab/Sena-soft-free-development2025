<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vuelos disponibles</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    .sugerencias {
      position: absolute;
      background: white;
      border: 1px solid #ccc;
      border-radius: 0.5rem;
      width: 100%;
      max-height: 150px;
      overflow-y: auto;
      z-index: 10;
    }
    .sugerencias div {
      padding: 0.5rem;
      cursor: pointer;
    }
    .sugerencias div:hover {
      background: #e5e7eb;
    }
  </style>
</head>

<body class="bg-gray-100 p-6 relative min-h-screen">

  <!-- 🔧 Ícono de configuración -->
  <button id="btnConfig" class="absolute top-4 right-6 text-gray-600 hover:text-blue-600">
    <i data-lucide="settings" class="w-8 h-8"></i>
  </button>

  <h2 class="text-3xl font-bold text-center text-blue-700 mb-2">Vuelos disponibles</h2>
  <h2 class="text-2xl font-bold text-center text-green-700 mb-6">Volando con Aerosoft</h2>

  <!-- 🔹 Formulario de búsqueda -->
  <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md mb-6 relative">
    <form id="buscador" class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">

      <!-- Tipo de vuelo -->
      <div class="col-span-3 flex gap-4 justify-center">
        <label><input type="radio" name="tipo" value="ida" checked> Solo ida</label>
        <label><input type="radio" name="tipo" value="ida-vuelta"> Ida y vuelta</label>
      </div>

      <!-- Origen -->
      <div class="relative">
        <input id="origen" type="text" placeholder="Origen" class="border p-2 rounded w-full">
        <div id="sugOrigen" class="sugerencias hidden"></div>
      </div>

      <!-- Destino -->
      <div class="relative">
        <input id="destino" type="text" placeholder="Destino" class="border p-2 rounded w-full">
        <div id="sugDestino" class="sugerencias hidden"></div>
      </div>

      <!-- Fechas -->
      <input id="fechaIda" type="date" class="border p-2 rounded w-full">
      <input id="fechaVuelta" type="date" class="border p-2 rounded w-full hidden">

      <!-- Pasajeros -->
      <select id="personas" class="border p-2 rounded w-full">
        <option value="1">1 persona</option>
        <option value="2">2 personas</option>
        <option value="3">3 personas</option>
        <option value="4">4 personas</option>
        <option value="5">5 personas</option>
      </select>

      <!-- Botón -->
      <button type="submit" class="bg-green-600 text-white font-bold py-2 rounded hover:bg-green-700 col-span-3">
        Buscar vuelos
      </button>
    </form>
  </div>

  <!-- 🔹 Resultados -->
  <div id="listaVuelos" class="grid gap-4 max-w-4xl mx-auto"></div>

  <script>
    lucide.createIcons();

    // ⚙️ Botón de configuración
    document.getElementById("btnConfig").addEventListener("click", () => {
      window.location.href = "login_admin.html";
    });

    // 🔹 Ciudades disponibles para autocompletar
    const ciudades = ["Bogotá", "Medellín", "Cali", "Cartagena", "San Andrés", "Barranquilla", "Bucaramanga", "Pereira"];

    const vuelos = [
      { id_vuelo: 1, origen: "Bogotá", destino: "Medellín", fecha_salida: "2025-10-25", fecha_llegada: "2025-10-25", modelo: "Airbus A320", precio_base: 250000 },
      { id_vuelo: 2, origen: "Bogotá", destino: "Cartagena", fecha_salida: "2025-10-26", fecha_llegada: "2025-10-26", modelo: "Boeing 737", precio_base: 320000 },
      { id_vuelo: 3, origen: "Cali", destino: "Bogotá", fecha_salida: "2025-10-27", fecha_llegada: "2025-10-27", modelo: "ATR 72", precio_base: 210000 },
      { id_vuelo: 4, origen: "Medellín", destino: "San Andrés", fecha_salida: "2025-10-28", fecha_llegada: "2025-10-28", modelo: "A320neo", precio_base: 400000 }
    ];

    const contenedor = document.getElementById("listaVuelos");
    const buscador = document.getElementById("buscador");
    const fechaVueltaInput = document.getElementById("fechaVuelta");

    // Mostrar/ocultar fecha de vuelta
    buscador.tipo.forEach(radio => {
      radio.addEventListener("change", () => {
        fechaVueltaInput.classList.toggle("hidden", radio.value !== "ida-vuelta" || !radio.checked);
      });
    });

    // 🔹 Autocompletado de Origen/Destino
    function configurarAutocompletado(inputId, sugerenciasId) {
      const input = document.getElementById(inputId);
      const contenedor = document.getElementById(sugerenciasId);

      input.addEventListener("input", () => {
        const texto = input.value.toLowerCase();
        contenedor.innerHTML = "";
        if (!texto) {
          contenedor.classList.add("hidden");
          return;
        }

        const coincidencias = ciudades.filter(c => c.toLowerCase().includes(texto));
        if (coincidencias.length === 0) {
          contenedor.classList.add("hidden");
          return;
        }

        contenedor.classList.remove("hidden");
        coincidencias.forEach(ciudad => {
          const div = document.createElement("div");
          div.textContent = ciudad;
          div.addEventListener("click", () => {
            input.value = ciudad;
            contenedor.classList.add("hidden");
          });
          contenedor.appendChild(div);
        });
      });

      document.addEventListener("click", (e) => {
        if (!contenedor.contains(e.target) && e.target !== input) {
          contenedor.classList.add("hidden");
        }
      });
    }

    configurarAutocompletado("origen", "sugOrigen");
    configurarAutocompletado("destino", "sugDestino");

    // 🔍 Buscar vuelos
    buscador.addEventListener("submit", e => {
      e.preventDefault();

      const tipo = buscador.tipo.value;
      const origen = document.getElementById("origen").value.trim().toLowerCase();
      const destino = document.getElementById("destino").value.trim().toLowerCase();
      const fechaIda = document.getElementById("fechaIda").value;
      const fechaVuelta = document.getElementById("fechaVuelta").value;
      const personas = parseInt(document.getElementById("personas").value);

      const resultados = vuelos.filter(v => 
        (!origen || v.origen.toLowerCase().includes(origen)) &&
        (!destino || v.destino.toLowerCase().includes(destino)) &&
        (!fechaIda || v.fecha_salida === fechaIda)
      );

      contenedor.innerHTML = resultados.length > 0 
        ? resultados.map(v => `
            <div class="bg-white shadow-lg p-4 rounded-lg">
              <h3 class="text-xl font-semibold text-blue-700">${v.origen} → ${v.destino}</h3>
              <p><strong>Fecha salida:</strong> ${v.fecha_salida}</p>
              ${tipo === "ida-vuelta" ? `<p><strong>Fecha regreso:</strong> ${fechaVuelta || "—"}</p>` : ""}
              <p><strong>Avión:</strong> ${v.modelo}</p>
              <p><strong>Precio base:</strong> $${v.precio_base}</p>
              <p><strong>Pasajeros:</strong> ${personas}</p>
              <a href="reservas.php?id_vuelo=${v.id_vuelo}" class="mt-3 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Reservar</a>
            </div>
          `).join("")
        : `<p class="text-center text-gray-600">No se encontraron vuelos con los criterios seleccionados.</p>`;
    });
  </script>

</body>
</html>

