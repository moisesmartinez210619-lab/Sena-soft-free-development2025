<?php
// backend/modelos/AsientosModel.php
require_once __DIR__ . "/../../config/conexion.php";

class AsientosModel {
    public static function obtenerAsientosPorAvion($id_avion) {
        global $conexion;
        $sql = "SELECT * FROM asientos WHERE id_avion = :id_avion ORDER BY codigo ASC";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id_avion' => $id_avion]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerAsientosDisponiblesPorAvion($id_avion) {
        global $conexion;
        $sql = "SELECT * FROM asientos WHERE id_avion = :id_avion AND disponible = 1 ORDER BY codigo ASC";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id_avion' => $id_avion]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function marcarOcupado($id_asiento) {
        global $conexion;
        $sql = "UPDATE asientos SET disponible = 0 WHERE id_asiento = :id_asiento";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id_asiento' => $id_asiento]);
    }

    public static function marcarDisponible($id_asiento) {
        global $conexion;
        $sql = "UPDATE asientos SET disponible = 1 WHERE id_asiento = :id_asiento";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id_asiento' => $id_asiento]);
    }

    public static function contarDisponibles($id_avion) {
        global $conexion;
        $sql = "SELECT COUNT(*) AS disponibles FROM asientos WHERE id_avion = :id_avion AND disponible = 1";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id_avion' => $id_avion]);
        return (int)$stmt->fetchColumn();
    }
}
?>
