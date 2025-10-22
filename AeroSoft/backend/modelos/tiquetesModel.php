<?php
// backend/modelos/TiquetesModel.php
require_once __DIR__ . "/../../config/conexion.php";

class TiquetesModel {

    public static function generarTiquete($datos) {
        global $conexion;
        $sql = "INSERT INTO tiquetes (id_reserva, codigo_tiquete, archivo_pdf, fecha_emision)
                VALUES (:id_reserva, :codigo_tiquete, :archivo_pdf, NOW())";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':id_reserva' => $datos['id_reserva'],
            ':codigo_tiquete' => $datos['codigo_tiquete'],
            ':archivo_pdf' => $datos['archivo_pdf']
        ]);
        return $conexion->lastInsertId();
    }

    public static function obtenerTiquetePorReserva($id_reserva) {
        global $conexion;
        $sql = "SELECT * FROM tiquetes WHERE id_reserva = :id_reserva LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id_reserva' => $id_reserva]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function obtenerTiquetePorCodigo($codigo_tiquete) {
        global $conexion;
        $sql = "SELECT * FROM tiquetes WHERE codigo_tiquete = :codigo_tiquete LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':codigo_tiquete' => $codigo_tiquete]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
