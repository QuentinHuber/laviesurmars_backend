<?php
/**
 * fichier de configuration qui déclare toutes les constantes utilisées dans les classes
**/

// global
const SITE_ROOT 	= 'http://192.168.0.48:80/laviesurmars_backend/';

// mysql
// base de données
const BDD_SGBD = 'mysql';
const BDD_DATABASE	= 'laviesurmars';
const BDD_HOST 		= 'localhost';
const BDD_PASSWORD	= '';
const BDD_USER		= 'root';

// tables principales
const TABLE_ADM		= 't_admin_adm';
const TABLE_ART		= 't_article_art';
const TABLE_AUT		= 't_autors_aut';
const TABLE_LOG		= 't_login_log';
const TABLE_MSU		= 't_media_subject_msu';
const TABLE_SUB		= 't_subject_sub';
const TABLE_USR		= 't_users_usr';

// tables de jointure
const TABLE_JAR		= 'tj_autor_article_jar';

// expéditeur mail
const EXP_MAIL		= 'jarce.boukoro@hetic.net'; //kT7@zdmzTK

// destinataire emails plateforme
const DEST_MAIL		= 'jarce.boukoro@hetic.net';

// statuts
const DEF_STA_SUPPR	= 2; // Numéro du statut supprimé
const DEF_STA_ACTIF	= 1; // Numéro du statut actif
const DEF_STA_NULL	= 0; // Numéro du statut null


?>
