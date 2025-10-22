<?php
// backend/helpers/generar_tiquete.php
require_once __DIR__ . "/../../config/conexion.php";
require_once __DIR__ . "/../modelos/ReservasModel.php";
require_once __DIR__ . "/../modelos/vuelosModel.php";
require_once __DIR__ . "/../modelos/vagadoresModel.php";

require_once __DIR__ . "/../../vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

function generarPDF($id_reserva) {
    global $conexion;

    // Obtener datos de la reserva
    $reserva = ReservasModel::obtenerReserva($id_reserva);
    $vuelo = VuelosModel::obtenerVueloPorId($reserva['id_vuelo']);
    $pagador = PagadoresModel::obtenerPagador($reserva['id_pagador']);

    if (!$reserva || !$vuelo || !$pagador) {
        return null; // si falta algo, no genera nada
    }

    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    $html = "
    <h1 style='text-align:center;'>Tiquete Aéreo</h1>
    <p><strong>Código de Reserva:</strong> {$reserva['codigo_reserva']}</p>
    <p><strong>Pasajero:</strong> {$pagador['nombres']}</p>
    <p><strong>Documento:</strong> {$pagador['tipo_documento']} {$pagador['numero_documento']}</p>
    <p><strong>Vuelo:</strong> {$vuelo['origen']} → {$vuelo['destino']}</p>
    <p><strong>Fecha Salida:</strong> {$vuelo['fecha_salida']}</p>
    <p><strong>Fecha Llegada:</strong> {$vuelo['fecha_llegada']}</p>
    <p><strong>Precio total:</strong> $ {$reserva['total']}</p>
    <p><strong>Estado:</strong> {$reserva['estado']}</p>
    <br>
    <p>Gracias por viajar con nosotros </p>
    ";

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $nombreArchivo = "tiquetes/tiquete_" . $reserva['codigo_reserva'] . ".pdf";
    $rutaGuardado = __DIR__ . "/../../" . $nombreArchivo;

    file_put_contents($rutaGuardado, $dompdf->output());

    return $nombreArchivo; // devuelve la ruta relativa del PDF, sin imprimir nada
}
