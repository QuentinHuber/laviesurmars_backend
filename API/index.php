<?php 
// $_SERVER['REQUEST_METHOD']               retour la méthode
// $_REQUEST                                Stock toutes les données
// file_get_contents('php://input')         Pour stocker les données POST
// json_decode($json)                       Decode en Objet php
// son_encode($jsonObj)                     Encode un tableau en objet JSON 


    /*
    //Method POST
    header('Access-Control-Allow-Origin: *');

    // Reading JSON POST using PHP
    $json = file_get_contents('php://input');
    $jsonObj = json_decode($json);

    echo json_encode($jsonObj);

    */


    //Method GET
    header('Access-Control-Allow-Origin: *');
    $data = $_REQUEST;
    $data["method"]=$_SERVER['REQUEST_METHOD'];

    echo json_encode($data);
    
?>