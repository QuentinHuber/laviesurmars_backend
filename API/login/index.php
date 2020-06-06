<?php 
    
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    include(dirname(__FILE__).'/../init.php');
    
    // Reading JSON POST using PHP
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $result = array();
    //$data = array('username'=> 'admin', 'password'=> '123456');
    // $login = $adm->login($data['username'], $data['password']);
    //$result = $login ? $login : 'notFound';
    $result['data'] = $data->{'username'};

    echo json_encode($result);



    include(dirname(__FILE__).'/../close.php');
?>