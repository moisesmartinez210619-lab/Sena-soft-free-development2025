<?php
// backend/modelos/PasajerosModel.php
require_once __DIR__ . "/../../config/conexion.php";

class PasajerosModel {
    public static function crearPasajero($datos) {
        global $conexion;
        $sql = "INSERT INTO pasajeros
                (primer_apellido, segundo_apellido, nombres, fecha_nacimiento, genero, tipo_documento, numero_documento, celular, correo, infante)
                VALUES (:primer_apellido, :segundo_apellido, :nombres, :fecha_nacimiento, :genero, :tipo_documento, :numero_documento, :celular, :correo, :infante)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':primer_apellido' => $datos['primer_apellido'],
            ':segundo_apellido' => $datos['segundo_apellido'] ?? null,
            ':nombres' => $datos['nombres'],
            ':fecha_nacimiento' => $datos['fecha_nacimiento'],
            ':genero' => $datos['genero'],
            ':tipo_documento' => $datos['tipo_documento'],
            ':numero_documento' => $datos['numero_documento'],
            ':celular' => $datos['celular'] ?? null,
            ':correo' => $datos['correo'] ?? null,
            ':infante' => !empty($datos['infante']) ? 1 : 0
        ]);
        return $conexion->lastInsertId();
    }

    public static function obtenerPasajerosPorReserva($id_reserva) {
        global $conexion;
        $sql = "SELECT p.* FROM pasajeros p
                INNER JOIN detalle_reserva d ON p.id_pasajero = d.id_pasajero
                WHERE d.id_reserva = :id_reserva";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id_reserva' => $id_reserva]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerPasajeroPorDocumento($numero_documento) {
        global $conexion;
        $sql = "SELECT * FROM pasajeros WHERE numero_documento = :numero_documento LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':numero_documento' => $numero_documento]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
