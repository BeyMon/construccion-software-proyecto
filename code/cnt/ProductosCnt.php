<?php

/*
 * Producto Controller
 */
include_once dirname(__FILE__) . '/../inc/config.php';
include_once dirname(__FILE__) . '/../inc/ErrCod.php';
require_once dirname(__FILE__) . '/../inc/GenFunc.php';
require_once dirname(__FILE__) . '/../inc/DBHandler.php';
include dirname(__FILE__) . "/../models/Producto.php";
header('Content-Type: application/json');
session_start();
$dbcon = \GenFunc::dbConnect();
$producto = new Producto($dbcon);
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
      $list = $producto->getSelectOptions();
      echo json_encode($list);
      break;
    }
    if (isset($request[0]) && $request[0] === 'count') {
      $recnum = $producto->getCount();
      echo $recnum;
      break;
    }
    if ($id) {
      // Obtener un producto
      $result = $producto->getById($id);
      if ($result) {
        echo json_encode($result);
      } else {
        http_response_code(404);
        echo json_encode(['error' => 'Producto encontrado']);
      }
    } else {
      // Listar todos (o implementar paginación si quieres)
      $all = $producto->getAll();
      echo json_encode($all);
    }
    break;
  case 'POST':
    // Crear nuevo producto
    error_log('nuevo producto');
    $ok = $producto->insert($input);
    http_response_code(201);
    echo json_encode(['success' => true]);
    break;
  case 'PUT':
    error_log('edita producto');
    $ok = $producto->update($input);
    http_response_code(201);
    echo json_encode(['success' => true]);
    break;
  case 'DELETE':
    if (!$id) {
      http_response_code(400);
      echo json_encode(['error' => 'Falta el ID para eliminar']);
      break;
    }
    // Eliminar producto
    $ok = $producto->remove($id);
    http_response_code(201);
    echo json_encode(['success' => true]);
    break;
  default:
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    break;
}

