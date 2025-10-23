✈️ AeroSoft – Sistema Web para Compra y Gestión de Vuelos
📘 Descripción general

AeroSoft es una aplicación web que permite a los usuarios buscar, reservar y registrar pagos de tiquetes aéreos de manera ágil e intuitiva.
Su diseño está orientado a la simplicidad y eficiencia, utilizando tecnologías web modernas para ofrecer una experiencia fluida tanto al usuario como al administrador.

🎨 Interfaz y diseño

El frontend fue desarrollado con HTML5, TailwindCSS, Bootstrap y JavaScript (vanilla), empleando una paleta de colores basada en tonos azules, verdes, amarillos y blanco, con gradientes que refuerzan la identidad visual de la marca.

El diseño es completamente responsivo, adaptándose a cualquier dispositivo.
Cuenta con fondos personalizados y contenedores translúcidos que mejoran la legibilidad sobre imágenes.

🧩 Tecnologías utilizadas

Frontend

HTML5

CSS3 (con TailwindCSS y Bootstrap)

JavaScript (vanilla)

Backend

PHP (para controladores y lógica de negocio)

Base de datos

MySQL (utilizando servidor local con XAMPP)

⚙️ Arquitectura del sistema

El proyecto sigue una arquitectura organizada en capas:

Frontend: interfaz del usuario y componentes visuales.

Backend: controladores PHP que procesan las solicitudes y comunican con la base de datos.

Base de datos: almacenamiento de información de vuelos, reservas y pagos.

Estructura de carpetas principal:

AeroSoft/
│
├── assets/
│   └── img/               → Imágenes (fondo, logotipos)
│
├── backend/
│   ├── controllers/       → Controladores PHP
│   ├── helpers/           → Funciones de apoyo
│   ├── lib/               → Archivos de conexión o librerías
│   ├── doc/               → Documentos generados
│   └── comprobantes/      → PDFs de tiquetes
│
├── config/                → Parámetros de conexión y entorno
│
├── views/                 → Interfaces HTML del sistema
│
└── index.html             → Página principal

🚀 Funcionalidades principales

Búsqueda de vuelos: filtrado por origen, destino y fechas.

Reserva de tiquetes: permite seleccionar pasajeros y generar códigos únicos.

Simulación y registro de pagos: integra métodos como tarjeta, PSE o efectivo.

Generación de comprobante PDF: cada reserva genera un tiquete descargable.

Panel administrativo: acceso restringido para gestionar vuelos, reservas y reportes.

👥 Roles del sistema

Usuario final: realiza búsquedas, reservas y pagos.

Administrador: gestiona vuelos, controla reportes y actualiza información.

📱 Requisitos no funcionales

Diseño adaptable (responsive design).

Interfaz amigable y moderna.

Validación de campos y control de errores.

Carga rápida y compatibilidad con navegadores actuales.

Manejo de datos seguro y eficiente.

 Instalación y ejecución local

Clonar o descargar el proyecto.

Colocar la carpeta completa dentro de htdocs en XAMPP.

Iniciar Apache y MySQL desde el panel de control.

Crear la base de datos desde phpMyAdmin e importar el archivo .sql del proyecto.

Acceder desde el navegador con:

http://localhost/Aerosoft/

📚 Herramientas de apoyo

XAMPP para servidor local.

GitHub para control de versiones.

Visual Studio Code como entorno de desarrollo.

👨‍💻 Autores

Desarrolladores:

Jesús Moisés Martínez Brown

Cristian Alejandro Alarcón Osorio

Centro de Formación:
Servicio Nacional de Aprendizaje – SENA
Regional Cundinamarca y San Andrés Isla
Proyecto SENA Soft 2025
