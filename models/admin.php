<?php
class Admin {

    private $table;

    public function __construct() {
        $this->table = TABLE_ADM; 
    }

    public function login(string $username, string $password) {
        global $db;
        global $cmn;

        $pass = $cmn->cryptPass($password);
        $data = array(
            'adm_sPwd'=> $pass,
            'adm_sPseudo'=> $username,
            'adm_sEmail'=> $username
        );
        $query = 'SELECT * FROM '.$this->table.' WHERE adm_sPwd = ? AND (adm_sPseudo = ? OR adm_sEmail = ?)';
        $verification = $db->sqlSingleResult($query, $data);
            
        return $verification;

    }
}
?>