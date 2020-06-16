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
        $db->sqlSimpleQuery("UPDATE ".TABLE_SUB." SET sub_iSta = ? WHERE sub_id = ?", array("sub_iSta"=>$_GET['sta'], "sub_id"=>$_GET['subject']));
        $recup = $ctn->listSubject();
        resultat($recup);
    }
    if (isset($_GET['article'])){
        $db->sqlSimpleQuery("DELETE FROM ".TABLE_ART." WHERE art_id = ?", array("art_id"=>$_GET['article']));
        $recup = $ctn->listArticle($_GET['sub']);
        resultat($recup);
    }
    else {
        errorParameter();
    }

    //resultat($_SERVER['REQUEST_METHOD']);
    
    echo json_encode($result);

    include(dirname(__FILE__).'/../close.php');
?>