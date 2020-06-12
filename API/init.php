<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

session_start();
/*ini_set('display_errors',1);
error_reporting(1);*/


setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

include_once(dirname(__FILE__).'/../config/config.php');

require_once(dirname(__FILE__).'/../models/common.php');
require_once(dirname(__FILE__).'/../models/object.php');
require_once(dirname(__FILE__).'/../models/query.php');
require_once(dirname(__FILE__).'/../models/admin.php');
require_once(dirname(__FILE__).'/../models/content.php');


$db  = new Query();
$cmn = new Common();
$adm = new Admin();
$ctn = new Content();
$adm->login('Bonsoir','Bonjour');
?>


