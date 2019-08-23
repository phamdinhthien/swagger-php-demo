<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include '../../config/configDB.php';
    include '../../model/student.php';
    
    $database = new Database();
    $db = $database->getConnection();
    $student = new Student($db);

    $results = $student->read();
    $num = $results->rowCount();
    if($num > 0){
    $student_arr = [];
    $student_arr['data'] = [];
    
    while ($row = $results->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $item = [
            'id'=>$id,
            'name'=>$name
        ];
        array_push($student_arr['data'], $item);
    }
    $student_arr['page'] = 1;

    echo json_encode($student_arr, JSON_UNESCAPED_UNICODE);
}


?>