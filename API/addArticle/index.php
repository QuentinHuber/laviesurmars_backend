<?php 
    include(dirname(__FILE__).'/../init.php');

    $result = array();
    $dataForm = $_REQUEST;

    if($_FILES['audio']['name'] == ''){
        $dataForm['audio'] = 0;
    }
    if($_FILES['v2']['name'] == ''){
        $dataForm['v2'] = 0;
    }
    if(!isset($_FILES['v1'])){
        $dataForm['v1'] = 0;
    }
    $dataForm['img1'] = !isset($_FILES['img1']) ? 0 : 1;
    $dataForm['img2'] = !isset($_FILES['img2']) ? 0 : 1;
    if(!isset($_POST['p2'])){
        $dataForm['p2'] = 0;
    }
    if(!isset($_POST['p3'])){
        $dataForm['p3'] = 0;
    }
    if(!isset($_POST['p4'])){
        $dataForm['p4'] = 0;
    }

    $add = $ctn->addArticle($dataForm);
    $result["data"]["return"] = $add;
    $result["data"]["error"] = false;

    echo json_encode($result);

    include(dirname(__FILE__).'/../close.php');
?>