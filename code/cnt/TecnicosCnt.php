<?php

/*
 * Tecnico Controller
 */
include_once dirname(__FILE__) . '/../inc/config.php';
include_once dirname(__FILE__) . '/../inc/ErrCod.php';
require_once dirname(__FILE__) . '/../inc/GenFunc.php';
require_once dirname(__FILE__) . '/../inc/DBHandler.php';
include dirname(__FILE__) . "/../models/Tecnico.php";
header('Content-Type: application/json');
session_start();
$dbcon = \GenFunc::dbConnect();
$tecnico = new Tecnico($dbcon);
// Lee la ruta y el método HTTP
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'] ?? '', '/'));
$id = isset($request[0]) ? (int) $request[0] : null;
// Lee el cuerpo JSON si existe
$input = json_decode(file_get_contents('php://input'), true);
// CRUD según método
switch ($method) {
  case 'GET':
    if (isset($request[0]) && $request[0] === 'lista') {
      $list = $tecnico->getSelectOptions();
      echo json_encode($list);
      break;
    }
    if (isset($request[0]) && $request[0] === 'count') {
      $recnum = $tecnico->getCount();
      echo $recnum;
      break;
    }
    if ($id) {
      // Obtener un tecnico
      $result = $tecnico->getById($id);
      if ($result) {
        echo json_encode($result);
      } else {
        http_response_code(404);
        echo json_encode(['error' => 'Técnico encontrado']);
      }
    } else {
      // Listar todos (o implementar paginación si quieres)
      $all = $tecnico->getAll();
      echo json_encode($all);
    }
    break;
  case 'POST':
    // Crear nuevo tecnico
    error_log('nuevo tecnico');
    $ok = $tecnico->insert($input);
    http_response_code(201);
    echo json_encode(['success' => true]);
    break;
  case 'PUT':
    error_log('edita tecnico');
    $ok = $tecnico->update($input);
    http_response_code(201);
    echo json_encode(['success' => true]);
    break;
  case 'DELETE':
    if (!$id) {
      http_response_code(400);
      echo json_encode(['error' => 'Falta el ID para eliminar']);
      break;
    }
    // Eliminar tecnico
    $ok = $tecnico->remove($id);
    http_response_code(201);
    echo json_encode(['success' => true]);
    break;
  default:
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    break;
}

