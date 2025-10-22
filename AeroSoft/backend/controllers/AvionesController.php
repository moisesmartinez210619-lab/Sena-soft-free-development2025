<?php
require_once __DIR__ . "/../modelos/avionesModel.php";

if (isset($_GET['accion'])) {
    switch ($_GET['accion']) {
        case 'listar':
            echo json_encode(AvionesModel::obtenerAviones());
            break;

        case 'crear':
            $datos = [
                'modelo' => $_POST['modelo'],
                'capacidad' => $_POST['capacidad'],
                'filas' => $_POST['filas'],
                'columnas' => $_POST['columnas']
            ];
            $id = AvionesModel::crearAvion($datos);
            echo json_encode(['success' => true, 'id_avion' => $id]);
            break;
    }
}
?>