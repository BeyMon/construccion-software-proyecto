<?php

/*
 * Orden Controller
 */
include_once dirname(__FILE__) . '/../inc/config.php';
include_once dirname(__FILE__) . '/../inc/ErrCod.php';
require_once dirname(__FILE__) . '/../inc/GenFunc.php';
require_once dirname(__FILE__) . '/../inc/DBHandler.php';
include dirname(__FILE__) . "/../models/Orden.php";
header('Content-Type: application/json');
session_start();
$dbcon = \GenFunc::dbConnect();
$orden = new Orden($dbcon);
// Lee la ruta y el método HTTP
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'] ?? '', '/'));
$id = isset($request[0]) ? (int) $request[0] : null;
// Lee el cuerpo JSON si existe
$input = json_decode(file_get_contents('php://input'), true);
// CRUD según método
switch ($method) {
  case 'GET':
    if (isset($request[0])) {
      switch ($request[0]) {
        case 'act' :
          $list = $orden->getAll(Orden::ACTIVO);
          echo json_encode($list);
          break;
        case 'fac' :
          $list = $orden->getAll();
          echo json_encode($list);
          break;
        case 'lista' :
          $list = $orden->getSelectOptions();
          echo json_encode($list);
          break;
        case 'count' :
          $recnum = $orden->getCount();
          echo $recnum;
          break;
      }
      break;
    }
    if ($id) {
      // Obtener un cliente
      $result = $orden->getById($id);
      if ($result) {
        echo json_encode($result);
      } else {
        http_response_code(404);
        echo json_encode(['error' => 'Cliente no encontrado']);
      }
    }
    //else {
    // Listar todos (o implementar paginación si quieres)
    //  $all = $orden->getAll();
    //  echo json_encode($all);
    // }
    break;
  case 'POST':
    // Crear nuevo orden
    $requiredFields = ['clicod', 'teccod', 'fecha', 'marca', 'modelo', 'imei', 'observ'];

    // Validación de campos
    foreach ($requiredFields as $field) {
      if (empty($input[$field])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => "El campo '$field' es obligatorio"]);
        exit;
      }
    }

    error_log('Nuevo orden recibido');

    $ok = $orden->insert($input);

    if ($ok) {
      http_response_code(201);
      echo json_encode(['success' => true]);
    } else {
      http_response_code(500);
      echo json_encode(['success' => false, 'error' => 'Error al insertar la orden']);
    }
    break;

  case 'PUT':
    error_log('edita cliente');
    $ok = $orden->update($input);
    http_response_code(201);
    echo json_encode(['success' => true]);
    break;
  case 'DELETE':
    if (!$id) {
      http_response_code(400);
      echo json_encode(['error' => 'Falta el ID para eliminar']);
      break;
    }
    // Eliminar cliente
    $ok = $orden->remove($id);
    http_response_code(201);
    echo json_encode(['success' => true]);
    break;
  default:
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    break;
}

