<?php

    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include '../../config/configDB.php';
    include '../../model/student.php';

    $database = new Database();
    $db = $database->getConnection();
    $student = new Student($db);

    $data = json_decode(file_get_contents('php://input'));
    $student->id = $data->id;
    $student->name = $data->name;
    if($student->update()){
        http_response_code(201);
        echo json_encode(
            ["message"=> "one student updated"]
        );
    } else{
        http_response_code(400);
        echo json_encode(
            ["message"=> "no student updated"]
        );
    }