<?php
      header("Access-Control-Allow-Origin: *");
      header("Content-Type: application/json; charset=UTF-8");
      header("Access-Control-Allow-Methods: POST");
      header("Access-Control-Max-Age: 3600");
      header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
      include '../../config/configDB.php';
      include '../../model/login.php';
      include '../../library/JWT.php';

      $database = new Database();
      $db = $database->getConnection();
      $login = new Login($db);

      $data = json_decode(file_get_contents('php://input'));
      $login->name = $data->name;
      if($login->checkLogin()){
        $key="check_login";
        $token = [
            'id'=>$login->id,
            'name'=>$login->name
        ];
        $jwt = JWT::encode($token, $key);
        echo json_encode([
            'token'=>$jwt
        ]);
      } else {
        echo json_encode([
          'message'=>'login failed'
      ]);
      }
?>