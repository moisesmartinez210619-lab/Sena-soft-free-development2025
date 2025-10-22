<?php
// backend/modelos/VuelosModel.php
require_once __DIR__ . "/../../config/conexion.php";

class VuelosModel {
    public static function obtenerVuelosDisponibles() {
        global $conexion;
        $sql = "SELECT v.*, a.modelo FROM vuelos v
                INNER JOIN aviones a ON v.id_avion = a.id_avion
                WHERE v.estado = 'disponible'
                ORDER BY v.fecha_salida ASC";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerVueloPorId($id_vuelo) {
        global $conexion;
        $sql = "SELECT v.*, a.modelo, a.capacidad FROM vuelos v
                INNER JOIN aviones a ON v.id_avion = a.id_avion
                WHERE v.id_vuelo = :id_vuelo";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id_vuelo' => $id_vuelo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function crearVuelo($datos) {
        global $conexion;
        $sql = "INSERT INTO vuelos (id_avion, origen, destino, fecha_salida, fecha_llegada, precio_base, estado)
                VALUES (:id_avion, :origen, :destino, :fecha_salida, :fecha_llegada, :precio_base, :estado)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':id_avion' => $datos['id_avion'],
            ':origen' => $datos['origen'],
            ':destino' => $datos['destino'],
            ':fecha_salida' => $datos['fecha_salida'],
            ':fecha_llegada' => $datos['fecha_llegada'],
            ':precio_base' => $datos['precio_base'],
            ':estado' => $datos['estado'] ?? 'disponible'
        ]);
        return $conexion->lastInsertId();
    }
}
?>
