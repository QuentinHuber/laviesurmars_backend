<?php 
    /*
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $data = $_REQUEST;
    $data["method"]=$_SERVER['REQUEST_METHOD'];
    echo json_encode($data);
    */
    header('Access-Control-Allow-Origin: *');
   // header('Access-Control-Allow-Headers: *Content-Type');
   // header('Content-Type: application/json');
   
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    
    // Reading JSON POST using PHP
    $json = file_get_contents('php://input');
    $jsonObj = json_decode($json);
    $data = array("test"=>"test");
    echo json_encode($data);
?>