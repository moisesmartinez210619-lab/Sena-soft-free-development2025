<?php
// backend/controladores/TiquetesController.php
require_once __DIR__ . "/backend/modelos/tiquetesModel.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id_reserva'])) {
        $tiquete = TiquetesModel::obtenerTiquetePorReserva($_GET['id_reserva']);
        echo json_encode($tiquete);
    } elseif (isset($_GET['codigo_tiquete'])) {
        $tiquete = TiquetesModel::obtenerTiquetePorCodigo($_GET['codigo_tiquete']);
        echo json_encode($tiquete);
    }
}
?>
