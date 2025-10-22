<?php
// backend/modelos/DetalleReservaModel.php
require_once __DIR__ . "/../../config/conexion.php";

class DetalleReservaModel {
    public static function agregarDetalle($datos) {
        global $conexion;
        $sql = "INSERT INTO detalle_reserva (id_reserva, id_pasajero, id_asiento, precio)
                VALUES (:id_reserva, :id_pasajero, :id_asiento, :precio)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':id_reserva' => $datos['id_reserva'],
            ':id_pasajero' => $datos['id_pasajero'],
            ':id_asiento' => $datos['id_asiento'],
            ':precio' => $datos['precio']
        ]);
        return $conexion->lastInsertId();
    }

    public static function obtenerDetallesPorReserva($id_reserva) {
        global $conexion;
        $sql = "SELECT d.*, p.nombres, p.primer_apellido, a.codigo AS asiento
                FROM detalle_reserva d
                INNER JOIN pasajeros p ON d.id_pasajero = p.id_pasajero
                INNER JOIN asientos a ON d.id_asiento = a.id_asiento
                WHERE d.id_reserva = :id_reserva";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id_reserva' => $id_reserva]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
