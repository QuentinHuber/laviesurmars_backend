<?php 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $data = $_REQUEST;
    $data["method"]=$_SERVER['REQUEST_METHOD'];
    echo json_encode($data);
?>