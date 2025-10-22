<?php
// backend/controladores/AsientosController.php
require_once __DIR__ . "/../modelos/asientosModel.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_avion'])) {
    $asientos = AsientosModel::obtenerAsientosDisponiblesPorAvion($_GET['id_avion']);
    echo json_encode($asientos);
}
?>
