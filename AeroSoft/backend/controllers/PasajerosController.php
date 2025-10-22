<?php
require_once __DIR__ . "/../modelos/pasajerosModel.php";

if (isset($_GET['accion'])) {
    switch ($_GET['accion']) {

        case 'crear':
            $datos = [
                'primer_apellido' => $_POST['primer_apellido'],
                'segundo_apellido' => $_POST['segundo_apellido'],
                'nombres' => $_POST['nombres'],
                'fecha_nacimiento' => $_POST['fecha_nacimiento'],
                'genero' => $_POST['genero'],
                'tipo_documento' => $_POST['tipo_documento'],
                'numero_documento' => $_POST['numero_documento'],
                'celular' => $_POST['celular'],
                'correo' => $_POST['correo'],
                'infante' => isset($_POST['infante']) ? 1 : 0
            ];
            $id = PasajerosModel::crearPasajero($datos);
            echo json_encode(['success' => true, 'id_pasajero' => $id]);
            break;

        case 'listar_por_reserva':
            $id_reserva = $_GET['id_reserva'];
            $pasajeros = PasajerosModel::obtenerPasajerosPorReserva($id_reserva);
            echo json_encode($pasajeros);
            break;
    }
}
?>