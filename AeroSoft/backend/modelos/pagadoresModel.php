<?php
// backend/modelos/PagadoresModel.php
require_once __DIR__ . "/../../config/conexion.php";

class PagadoresModel {
    public static function crearPagador($datos) {
        global $conexion;
        $sql = "INSERT INTO pagadores (nombres, tipo_documento, numero_documento, correo, telefono, direccion)
                VALUES (:nombres, :tipo_documento, :numero_documento, :correo, :telefono, :direccion)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':nombres' => $datos['nombres'],
            ':tipo_documento' => $datos['tipo_documento'],
            ':numero_documento' => $datos['numero_documento'],
            ':correo' => $datos['correo'],
            ':telefono' => $datos['telefono'] ?? null,
            ':direccion' => $datos['direccion'] ?? null
        ]);
        return $conexion->lastInsertId();
    }

    public static function obtenerPagador($id) {
        global $conexion;
        $sql = "SELECT * FROM pagadores WHERE id_pagador = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function buscarPorDocumentoOCorreo($numero_documento, $correo) {
        global $conexion;
        $sql = "SELECT * FROM pagadores WHERE numero_documento = :numero_documento OR correo = :correo LIMIT 1";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([':numero_documento' => $numero_documento, ':correo' => $correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
