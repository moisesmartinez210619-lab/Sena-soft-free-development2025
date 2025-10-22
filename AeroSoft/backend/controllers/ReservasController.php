<?php
// backend/controladores/ReservasController.php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . "/../modelos/reservasModel.php";
require_once __DIR__ . "/../modelos/pagadoresModel.php";
require_once __DIR__ . "/../modelos/vuelosModel.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $datosPagador = [
        'nombres' => $_POST['nombres'],
        'tipo_documento' => $_POST['tipo_documento'],
        'numero_documento' => $_POST['numero_documento'],
        'correo' => $_POST['correo'],
        'telefono' => $_POST['telefono'] ?? null,
        'direccion' => $_POST['direccion'] ?? null
    ];

    // Buscar o crear pagador
    $pagador = PagadoresModel::buscarPorDocumentoOCorreo($datosPagador['numero_documento'], $datosPagador['correo']);
    $id_pagador = $pagador ? $pagador['id_pagador'] : PagadoresModel::crearPagador($datosPagador);

    $id_vuelo = $_POST['id_vuelo'];

    // Verificar si la reserva esta duplicada
    $reservaExistente = ReservasModel::buscarReservaExistente($id_pagador, $id_vuelo);
    if ($reservaExistente) {
        echo json_encode([
            'success' => false,
            'mensaje' => 'Ya existe una reserva para este usuario en este vuelo.',
            'codigo' => $reservaExistente['codigo_reserva']
        ]);
        exit;
    }

    // Crear nueva reserva
    $codigo = 'RSV-' . strtoupper(bin2hex(random_bytes(3)));
    $datosReserva = [
        'id_pagador' => $id_pagador,
        'id_vuelo' => $id_vuelo,
        'codigo_reserva' => $codigo,
        'estado' => 'pendiente',
        'total' => $_POST['total'] ?? 0
    ];

    $id_reserva = ReservasModel::crearReserva($datosReserva);

    echo json_encode([
        'success' => true,
        'mensaje' => 'Reserva creada correctamente.',
        'id_reserva' => $id_reserva,
        'codigo' => $codigo
    ]);
    exit;
} else {
    echo json_encode(['success' => false, 'mensaje' => 'Método no permitido']);
}
?>
