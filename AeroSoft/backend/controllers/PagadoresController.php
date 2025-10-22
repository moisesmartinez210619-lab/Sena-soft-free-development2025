<?php
// backend/controladores/PagadoresController.php
require_once __DIR__ . "/../modelos/pagadoresModel.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'nombres' => $_POST['nombres'],
        'tipo_documento' => $_POST['tipo_documento'],
        'numero_documento' => $_POST['numero_documento'],
        'correo' => $_POST['correo'],
        'telefono' => $_POST['telefono'] ?? null,
        'direccion' => $_POST['direccion'] ?? null
    ];

    // Buscar pagador existente
    $pagadorExistente = PagadoresModel::buscarPorDocumentoOCorreo(
        $datos['numero_documento'],
        $datos['correo']
    );

    if ($pagadorExistente) {
        echo json_encode([
            'success' => true,
            'mensaje' => 'Pagador ya existente, se reutiliza su ID.',
            'id_pagador' => $pagadorExistente['id_pagador']
        ]);
    } else {
        $id = PagadoresModel::crearPagador($datos);
        echo json_encode([
            'success' => true,
            'mensaje' => 'Pagador creado correctamente.',
            'id_pagador' => $id
        ]);
    }
}
?>
