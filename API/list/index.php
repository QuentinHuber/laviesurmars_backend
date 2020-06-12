<?php 
    include(dirname(__FILE__).'/../init.php');

    $result = array();
   
    if (isset($_GET['q'])){
        if($_GET['q']==="subject"){
            $result["data"]["return"] = $ctn->listSubject();
            $result["data"]["error"] = false;
        }
        else{
            $result["data"]["return"] = "Paramètres incorrects";
            $result["data"]["error"] = true;
        }
    }
    else {
        $result["data"]["return"] = "Paramètres incorrects";
        $result["data"]["error"] = true;
    }
    
    echo json_encode($result);

    include(dirname(__FILE__).'/../close.php');
?>