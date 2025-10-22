<?php
// backend/modelos/ReservasModel.php
require_once __DIR__ . "/../../config/conexion.php";

class ReservasModel {
    public static function crearReserva($datos) {
        global $conexion;
        $sql = "INSERT INTO reservas (id_pagador, id_vuelo, codigo_reserva, estado, total)
                VALUES (:id_pagador, :id_vuelo, :codigo_reserva, :estado, :total)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':id_pagador' => $datos['id_pagador'],
            ':id_vuelo' => $datos['id_vuelo'],
            ':codigo_reserva' => $datos['codigo_reserva'],
            ':estado' => $datos['estado'],
            ':total' => $datos['total']
        ]);
        return $conexion->lastInsertId();
    }

    public static function buscarReservaExistente($id_pagador, $id_vuelo) {
        global $conexion;
        $sql = "SELECT * FROM reservas WHERE id_pagador = :id_pagador AND id_vuelo = :id_vuelo LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':id_pagador' => $id_pagador,
            ':id_vuelo' => $id_vuelo
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function obtenerReserva($id_reserva) {
        global $conexion;
        $sql = "SELECT * FROM reservas WHERE id_reserva = :id_reserva";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id_reserva' => $id_reserva]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function obtenerReservaPorCodigo($codigo_reserva) {
    global $conexion;
    $sql = "SELECT * FROM reservas WHERE codigo_reserva = :codigo_reserva LIMIT 1";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([':codigo_reserva' => $codigo_reserva]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}
