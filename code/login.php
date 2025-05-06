<?php

/*
 * Proceso de login
 */
include_once dirname(__FILE__) . '/inc/config.php';
include_once dirname(__FILE__) . '/inc/ErrCod.php';
require_once dirname(__FILE__) . '/inc/GenFunc.php';
require_once dirname(__FILE__) . '/inc/DBHandler.php';

header('Content-Type: application/json');
session_start();

// Leer JSON
$input = json_decode(file_get_contents('php://input'), true);
$uid = trim($input['uid'] ?? '');
$pwd = trim($input['pwd'] ?? '');

try {
  if (!empty($uid) && !empty($pwd)) :
    // Conexion a la base de datos
    $dbcon = GenFunc::dbConnect();
    $db = new DbHandler($dbcon);
    // Validar el usuario y la contraseña en la base de datos
    if (GenFunc::checkUser($db, $uid, $pwd)) :
      GenFunc::logSys("(login) I:Ingreso Exitoso [" . $uid . "]");
      $tokenValido = $db->checkExpireToken($uid, 1);
      $token = '';
      $fecexp = '';
      if ($tokenValido) :
        // Obtener el token existente y actualizar la IP
        GenFunc::logSys("(login) I:Devuelve el Token");
        $jwt = $db->getUserToken($uid);
        if ($jwt) :
          $token = $jwt['token'];
          $fecexp = $jwt['fecexp'];
        else:
          GenFunc::logSys("(login - " . __LINE__ . ") E:E110 " . ErrCod::E110);
          $response["code"] = CODE401;
          $response["msg"] = "Error E110: " . ErrCod::E110;
          echo json_encode($response);
        endif;
      else:
        // Generar un nuevo token
        GenFunc::logSys("(login) I:Genera Token ");
        $token = bin2hex(random_bytes(16));
        $fecexp = time() + TOKENMAXTIME;
        // Eliminar registros anteriores del usuario y registrar el nuevo token
        GenFunc::logSys("(login) I:Elimina Registro Anterior");
        $db->deleteTokenRegister($uid);

        // Registro de Token
        GenFunc::logSys("(login) I:Crea Registro ");
        $db->userTokenRegister($uid, $token, $fecexp);
      endif;

      // Procesa respuesta
      GenFunc::logSys("(login) I:Ingreso Exitoso ");

      $response["code"] = CODE200;
      $response["msg"] = "Ingreso Exitoso ";
      $response["data"] = [
          'token' => $token,
          'expira' => date('Y-m-d H:i:s.u', $fecexp),
      ];
      echo json_encode($response);
    endif;

  else :
    // Manejar el caso en el que el usuario o la contraseña esten vaci­os
    if (empty($uid)) {
      GenFunc::logSys("(login) E:E107 " . ErrCod::E107);
      $response["code"] = CODE401;
      $response["msg"] = "Error E107: " . ErrCod::E107;
      echo json_encode($response);
    } elseif (empty($pwd)) {
      GenFunc::logSys("(login) E:E108 " . ErrCod::E108);
      $response["code"] = CODE401;
      $response["msg"] = "Error E108: " . ErrCod::E108;
      echo json_encode($response);
    }
  endif;
} catch (Exception $e) {
  // Error
  error_log($e->getMessage());
  GenFunc::logSys("(login Exception) E:Error " . $e->getCode() . ": " . $e->getMessage());
  $response["code"] = CODE400;
  $response["msg"] = $e->getMessage();
  $response["code_error"] = $e->getCode();
  echo json_encode($response);
} finally {
  // Cerrar conexiones y liberar recursos
  $db = null;
  $dbcon = null;
}


