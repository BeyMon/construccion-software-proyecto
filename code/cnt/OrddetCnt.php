<?php

/*
 * Orden Controller
 */
include_once dirname(__FILE__) . '/../inc/config.php';
include_once dirname(__FILE__) . '/../inc/ErrCod.php';
require_once dirname(__FILE__) . '/../inc/GenFunc.php';
require_once dirname(__FILE__) . '/../inc/DBHandler.php';
require_once dirname(__FILE__) . '/../models/Orddet.php';

//header('Content-Type: application/json');
session_start();
$dbcon = \GenFunc::dbConnect();
$detalle = new Orddet($dbcon);
// Lee la ruta y el método HTTP
$method = $_SERVER['REQUEST_METHOD'];

$request = explode('/', trim($_SERVER['PATH_INFO'] ?? '', '/'));
$id = isset($request[0]) ? (int) $request[0] : null;
// Lee el cuerpo JSON si existe
$input = json_decode(file_get_contents('php://input'), true);
error_log(json_encode($input));
// CRUD según método
switch ($method) {
    case 'GET':
        // Aquí puedes agregar futuras consultas si es necesario
        break;

    case 'POST':
        try {
            // Validar que hay datos
            if (!$input || !isset($input['ordid'])) {
                GenFunc::sendJsonResponse([
                    'code' => 400,
                    'msg' => 'Faltan datos obligatorios',
                    'code_error' => 'E151',
                ]);
            }

            // Agregar fecha actual como 'fecdet'
            $input['fecdet'] = date('Y-m-d H:i:s');

            // Insertar en la base de datos
            $ok = $detalle->insert($input);

            if ($ok) {
                GenFunc::sendJsonResponse(['data' => 1]);
            } else {
                throw new AppException('No se pudo guardar el detalle', 500);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            GenFunc::sendJsonResponse([
                'code' => 500,
                'msg' => 'Error interno',
                'error_detail' => $e->getMessage(),
            ]);
        }
        break;

    default:
        GenFunc::sendJsonResponse(['code' => 405, 'msg' => Errcod::E150]);
        break;
}