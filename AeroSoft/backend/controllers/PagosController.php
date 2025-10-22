<?php
// backend/controladores/PagosController.php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . "/../modelos/pagosModel.php";
require_once __DIR__ . "/../modelos/reservasModel.php";
require_once __DIR__ . "/../modelos/tiquetesModel.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $codigo_reserva = $_POST['codigo_reserva'] ?? null;
    $metodo = $_POST['metodo'] ?? null;

    // Validar campos
    if (!$codigo_reserva || !$metodo) {
        echo json_encode(['success' => false, 'mensaje' => 'Faltan datos requeridos.']);
        exit;
    }

    // Buscar reserva por código
    $reserva = ReservasModel::obtenerReservaPorCodigo($codigo_reserva);
    if (!$reserva) {
        echo json_encode(['success' => false, 'mensaje' => 'No se encontró ninguna reserva con ese código.']);
        exit;
    }

    $id_reserva = $reserva['id_reserva'];

    try {
        // Registrar pago
        $id_pago = PagosModel::registrarPago([
            'id_reserva' => $id_reserva,
            'metodo' => $metodo,
            'resultado' => 'exitoso'
        ]);

        // Cambiar estado de la reserva
        ReservasModel::actualizarEstado($id_reserva, 'pagado');

        // Generar PDF
        require_once __DIR__ . "/../helpers/generar_ticked.php";
        $archivo_pdf = generarPDF($id_reserva);

        // Guardar tiquete
        $codigo_tiquete = "TCK-" . strtoupper(bin2hex(random_bytes(3)));
        TiquetesModel::generarTiquete([
            'id_reserva' => $id_reserva,
            'codigo_tiquete' => $codigo_tiquete,
            'archivo_pdf' => $archivo_pdf
        ]);

        echo json_encode([
            'success' => true,
            'mensaje' => 'Pago registrado correctamente.',
            'codigo_tiquete' => $codigo_tiquete,
            'archivo_pdf' => $archivo_pdf
        ]);

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'mensaje' => 'Error en BD: ' . $e->getMessage()]);
    }

} else {
    echo json_encode(['success' => false, 'mensaje' => 'Método no permitido']);
}
?>
