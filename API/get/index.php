<?php 
    include(dirname(__FILE__).'/../init.php');

    $result = array();
    
    function errorParameter(){
        global $result;
        $result["data"]["return"] = "Paramètres incorrects";
        $result["data"]["error"] = true;
    }

    function resultat($return){
        global $result;
        $result["data"]["return"] = $return;
        $result["data"]["error"] = false;
    }
   

    if (isset($_GET['subject'])){
        $recup = $ctn->subject($_GET['id']);
        resultat($recup);
    }
    if (isset($_GET['article'])){
        $recup = $ctn->article($_GET['id']);
        resultat($recup);
    }
    if (isset($_GET['features'])){
        $recup = $ctn->features();
        resultat($recup);
    }
    
    echo json_encode($result);

    include(dirname(__FILE__).'/../close.php');
?>