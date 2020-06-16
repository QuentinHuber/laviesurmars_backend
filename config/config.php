<?php
/**
 * fichier de configuration qui déclare toutes les constantes utilisées dans les classes
**/

// global local
 const SITE_ROOT 	= 'http://192.168.0.48:80/laviesurmars_backend/';

// global online
// const SITE_ROOT 	= 'https://e-cine.xyz/laviesurmars_backend/';
// http://192.168.0.48:80

// mysql
// base de données Local

const BDD_SGBD = 'mysql';
const BDD_DATABASE	= 'laviesurmars';
const BDD_HOST 		= 'localhost';
const BDD_PASSWORD	= '';
const BDD_USER		= 'root';

// base de données online
/*
const BDD_SGBD = 'mysql';
const BDD_DATABASE	= 'ecine1359178';
const BDD_HOST 		= '185.98.131.109';
const BDD_PASSWORD	= 'r8r86ya5nq';
const BDD_USER		= 'ecine1359178';
*/


// tables principales
const TABLE_ADM		= 't_admins_adm';
const TABLE_ART		= 't_article_art';
const TABLE_LOG		= 't_login_log';
const TABLE_SUB		= 't_subject_sub';
const TABLE_USR		= 't_user_usr';
const TABLE_TYA     = 't_type_article_tya';
const TABLE_FEA     = 't_features_fea';
// expéditeur mail
const EXP_MAIL		= 'jarce.boukoro@hetic.net'; //kT7@zdmzTK

// destinataire emails plateforme
const DEST_MAIL		= 'jarce.boukoro@hetic.net';

// statuts
const DEF_STA_SUPPR	= 2; // Numéro du statut supprimé
const DEF_STA_ACTIF	= 1; // Numéro du statut actif
const DEF_STA_NULL	= 0; // Numéro du statut null


?>
