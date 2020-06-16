<?php 
    include(dirname(__FILE__).'/../init.php');

    $result = array();
    $dataForm = $_REQUEST;

    if(isset($_POST['image'])){
        $dataForm['image'] = 0;
        $edit = $ctn->editSubject($dataForm);
        $result["data"]["return"] = $edit;
        $result["data"]["error"] = false;
    }
    else{
        if(!$cmn->sizeImage($_FILES["image"],1000)){
            $result["data"]["return"] = 'size_1M';
            $result["data"]["error"] = false;
        }
        else{
            $dataForm['image'] = 1;
            $edit = $ctn->editSubject($dataForm);
            $result["data"]["return"] = $edit;
            $result["data"]["error"] = false;
        }
    }

    echo json_encode($result);

    include(dirname(__FILE__).'/../close.php');
?>