<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de sesión - Administrador</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-blue-50 flex items-center justify-center h-screen">

  <div class="bg-white p-8 rounded-lg shadow-lg w-96">
    <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">Acceso de administrador</h2>

    <form id="formLogin" class="space-y-4">
      <input type="email" id="correo" placeholder="Correo de administrador" required class="w-full p-2 border rounded">
      <input type="password" id="clave" placeholder="Contraseña" required class="w-full p-2 border rounded">
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Ingresar</button>
    </form>

    <p id="mensaje" class="text-center text-red-600 mt-4 hidden">Correo o contraseña incorrectos</p>
  </div>

  <script>
  document.getElementById("formLogin").addEventListener("submit", e => {
    e.preventDefault();

    const correo = document.getElementById("correo").value.trim();
    const clave = document.getElementById("clave").value.trim();

    // Solo el admin puede ingresar
    if (correo === "admin@aerosoft.com" && clave === "12345") {
      localStorage.setItem("admin", "true");
      window.location.href = "panel_admin.html";
    } else {
      document.getElementById("mensaje").classList.remove("hidden");
    }
  });
  </script>

</body>
</html>
