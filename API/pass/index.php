<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
include(dirname(__FILE__).'/../init.php');

    // Reading JSON POST using PHP
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $result = array();
    if(is_array($data)) {
        $pass = $adm->changePassVerif($data['data']);
        if (!$pass) {
            $result["data"]["return"] = 'notFound';
            $result["data"]["error"] = false;
        }else {
            $update = $adm->changePass($data['data']);
            $result["data"]["return"] = 'found';
            $result["data"]["error"] = false;
        }
    }
    else{
        $result["data"]["error"] = 'Ce n\'est pas un tableau';
        $result["data"]["return"] = false;
    }
    echo json_encode($result);

include(dirname(__FILE__).'/../close.php');
?>