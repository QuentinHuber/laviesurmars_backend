<?php 
    include(dirname(__FILE__).'/../init.php');
    
    // Reading JSON POST using PHP
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    $result = array();

    if(is_array($data))
    {
        $login = $adm->login($data["data"]['username'], $data["data"]['password']);
        
        $result["data"]["return"] = $login ? $login : 'notFound';
        $result["data"]["error"] = false;
    }
    else{
        $result["data"]["error"] = 'Ce n\'est pas un tableau';
        $result["data"]["return"] = false;
    }
    echo json_encode($result);



    include(dirname(__FILE__).'/../close.php');
?>