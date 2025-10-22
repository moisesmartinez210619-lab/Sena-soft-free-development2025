<?php
require_once __DIR__ . "/../modelos/DetalleReservaModel.php";

if (isset($_GET['accion'])) {
    switch ($_GET['accion']) {

        case 'agregar':
            $datos = [
                'id_reserva' => $_POST['id_reserva'],
                'id_pasajero' => $_POST['id_pasajero'],
                'id_asiento' => $_POST['id_asiento'],
                'precio' => $_POST['precio']
            ];
            DetalleReservaModel::agregarDetalle($datos);
            echo json_encode(['success' => true]);
            break;

        case 'listar':
            $detalles = DetalleReservaModel::obtenerDetallesPorReserva($_GET['id_reserva']);
            echo json_encode($detalles);
            break;
    }
}
?>