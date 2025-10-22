<?php
// backend/controladores/VuelosController.php
require_once __DIR__ . "/../modelos/vuelosModel.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion'])) {
    if ($_GET['accion'] === 'listar') {
        $vuelos = VuelosModel::obtenerVuelosDisponibles();
        echo json_encode($vuelos);
    } elseif ($_GET['accion'] === 'detalle' && isset($_GET['id_vuelo'])) {
        $vuelo = VuelosModel::obtenerVueloPorId($_GET['id_vuelo']);
        echo json_encode($vuelo);
    }
}
?>
