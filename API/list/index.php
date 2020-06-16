<?php 
    include(dirname(__FILE__).'/../init.php');

    $result = array();

    function resultat($return){
        global $result;
        $result["data"]["return"] = $return;
        $result["data"]["error"] = false;
    }

    function statut() {
        if(isset($_GET['sta'])){
            if($_GET['sta'] === '' || !is_int($_GET['sta'])){
                $_GET['sta'] = null;
            }
        }
        else{
            $_GET['sta'] = null;
        }
        return $_GET['sta'];
    }

    function joint() {
        if(isset($_GET['j'])){
            if($_GET['j'] === '' || !is_numeric($_GET['j'])){
                $_GET['j'] = null;
            }
        }
        else{
            $_GET['j'] = null;
        }
        return $_GET['j'];
    }

    function errorParameter(){
        global $result;
        $result["data"]["return"] = "Paramètres incorrects";
        $result["data"]["error"] = true;
    }
   

    if (isset($_GET['q'])){
        if($_GET['q']==="subject"){
            resultat($ctn->listSubject(statut()));
        }
        else if($_GET['q']==="article"){
            resultat($ctn->listArticle(joint()));
        }
        else if($_GET['q']==="theme"){
            resultat($ctn->type_article());
        }
        else{
            errorParameter();
        }
    }
    else {
        errorParameter();
    }
    
    echo json_encode($result);

    include(dirname(__FILE__).'/../close.php');
?>