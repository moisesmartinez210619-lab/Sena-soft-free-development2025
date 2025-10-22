<?php
// backend/modelos/PagosModel.php
require_once __DIR__ . "/../../config/conexion.php";

class PagosModel {
    public static function registrarPago($datos) {
        global $conexion;
        $sql = "INSERT INTO pagos (id_reserva, metodo, resultado, fecha_pago)
                VALUES (:id_reserva, :metodo, :resultado, NOW())";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':id_reserva' => $datos['id_reserva'],
            ':metodo' => $datos['metodo'],
            ':resultado' => $datos['resultado'] ?? 'exitoso'
        ]);
        return $conexion->lastInsertId();
    }

    public static function obtenerPagosPorReserva($id_reserva) {
        global $conexion;
        $sql = "SELECT * FROM pagos WHERE id_reserva = :id_reserva ORDER BY fecha_pago DESC";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id_reserva' => $id_reserva]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function actualizarEstado($id_reserva, $estado) {
    global $conexion;
    $sql = "UPDATE reservas SET estado = :estado WHERE id_reserva = :id_reserva";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([':estado' => $estado, ':id_reserva' => $id_reserva]);
}

}
?>
