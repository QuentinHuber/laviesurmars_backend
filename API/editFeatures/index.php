<?php 
    include(dirname(__FILE__).'/../init.php');

    $result = array();
    $dataForm = $_REQUEST;

    if($_FILES['video']['name'] == ''){
        $dataForm['video'] = 0;
    }
   
    $edit = $ctn->editFeautures($dataForm);
    $result["data"]["return"] = $edit;
    $result["data"]["error"] = false;

    echo json_encode($result);

    include(dirname(__FILE__).'/../close.php');
?>