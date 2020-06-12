<?php 
    include(dirname(__FILE__).'/../init.php');

    $result = array();
    $dataForm = $_REQUEST;

    if(!$cmn->sizeImage($_FILES["image"],1000)){
        $result["data"]["return"] = 'size_1M';
        $result["data"]["error"] = false;
    }
    else{
        $add = $ctn->addSubject($dataForm);
        $result["data"]["return"] = $add;
        $result["data"]["error"] = false;
    }
    echo json_encode($result);

    include(dirname(__FILE__).'/../close.php');
?>