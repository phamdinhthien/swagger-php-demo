<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include '../../config/configDB.php';
    include '../../model/student.php';
    
    $database = new Database();
    $db = $database->getConnection();
    $student = new Student($db);
    $student->id = isset($_GET['id'])?$_GET['id']:die();
    $results = $student->read_single();
    $num = $results->rowCount();
    $student_arr = [];
    $student_arr['data'] = [];
    if($num){
    $row = $results->fetch(PDO::FETCH_ASSOC);
        extract($row);
        $item = [
            'id'=>$id,
            'name'=>$name
        ];
        array_push($student_arr['data'], $item);
    }else{
        array_push($student_arr['data'], ["message"=>"no data"]);
    }
    echo json_encode($student_arr, JSON_UNESCAPED_UNICODE);



?>