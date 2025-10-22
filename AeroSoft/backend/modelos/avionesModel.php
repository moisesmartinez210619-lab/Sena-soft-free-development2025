<?php
// backend/modelos/AvionesModel.php
require_once __DIR__ . "/../../config/conexion.php";

class AvionesModel {
    public static function obtenerAviones() {
        global $conexion;
        $sql = "SELECT * FROM aviones ORDER BY modelo";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerAvionPorId($id_avion) {
        global $conexion;
        $sql = "SELECT * FROM aviones WHERE id_avion = :id_avion";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id_avion' => $id_avion]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function crearAvion($datos) {
        global $conexion;
        $sql = "INSERT INTO aviones (modelo, capacidad, filas, columnas)
                VALUES (:modelo, :capacidad, :filas, :columnas)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':modelo' => $datos['modelo'],
            ':capacidad' => $datos['capacidad'],
            ':filas' => $datos['filas'],
            ':columnas' => $datos['columnas']
        ]);
        return $conexion->lastInsertId();
    }
}
?>
